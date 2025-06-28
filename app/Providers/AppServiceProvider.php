<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Trip;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
      public function boot()
    {
       View::composer('layouts.dashboard', function ($view) {

    $trips = Trip::where('status', 'aktif')->get();

    $tripEvents = $trips->map(function ($trip) {
        return [
            'name' => $trip->nama_trip,
            'start' => $trip->tanggal_mulai,
            'end' => $trip->tanggal_selesai,
        ];
    });

    $view->with('tripEvents', $tripEvents);
});

    }
}
