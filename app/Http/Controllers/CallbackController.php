<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    public function handle(Request $request)
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $type = $callback->getType();
            $orderId = $callback->getNotification()->order_id;
            $order = null;
            $isPelunasan = false;


                switch ($type) {
                case 'order':
                    if (Transaksi::where('pelunasan_order_id', $orderId)->exists()) {
                        $order = Transaksi::where('pelunasan_order_id', $orderId)->first();
                        $isPelunasan = true;
                    } else {
                        $order = Transaksi::where('payment_order_id', $orderId)->first();
                    }
                    break;
            }

            if (!$order) {
                Log::error('Order tidak ditemukan', ['order_id' => $orderId]);
                return response()->json(['error' => true, 'message' => 'Order not found'], 404);
            }

            // SUCCESS
            if ($callback->isSuccess()) {
                if ($isPelunasan) {
                    $order->status_pembayaran = 'lunas';
                    $order->status = 'menunggu'; // Trip belum dimulai
                } else {
                    $order->status_pembayaran = 'dp';
                }

                $order->save();

                Log::info('Pembayaran berhasil diproses', [
                    'order_id' => $orderId,
                    'status_pembayaran' => $order->status_pembayaran,
                ]);
            }

            // PENDING
            elseif ($callback->isPending()) {
                $order->status_pembayaran = 'menunggu dp';
                $order->save();

                Log::info('Pembayaran pending', ['order_id' => $orderId]);
            }

            // EXPIRE
            elseif ($callback->isExpire()) {
                $order->status_pembayaran = 'gagal';
                $order->status = 'gagal';
                $order->save();

                Log::info('Pembayaran expired', ['order_id' => $orderId]);
            }

            // CANCELLED
            elseif ($callback->isCancelled()) {
                $order->status_pembayaran = 'gagal';
                $order->status = 'batal';
                $order->save();

                Log::info('Pembayaran dibatalkan', ['order_id' => $orderId]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification successfully processed',
            ]);
        }
    }
}

