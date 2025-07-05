<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use Carbon\Carbon;
use Symfony\Component\Console\Attribute\AsCommand;
use Laravel\Pennant\Feature;
use Illuminate\Console\Scheduling\Schedule;

#[AsCommand(name: 'transaksi:update-status')]
class UpdateTripStatus extends Command
{
    protected $description = 'Update status pembayaran berdasarkan tanggal trip';

    public function handle(): void
    {
        Transaksi::with('trip')
            ->where('status_pembayaran', 'lunas')
            ->whereHas('trip', function ($q) {
                $q->whereDate('tanggal_mulai', '<=', now()->addDay());
            })
            ->get()
            ->each(function ($t) {
                $t->update(['status_pembayaran' => 'berlangsung']);
            });

        Transaksi::with('trip')
            ->where('status_pembayaran', 'berlangsung')
            ->whereHas('trip', function ($q) {
                $q->whereDate('tanggal_selesai', '<', now());
            })
            ->get()
            ->each(function ($t) {
                $t->update(['status_pembayaran' => 'selesai']);
            });
    }

    // ⬇️ Jadwalkan di sini, bukan lagi di Kernel
    public function schedule(Schedule $schedule): void
    {
        $schedule->daily(); // jalan setiap hari
    }
}
