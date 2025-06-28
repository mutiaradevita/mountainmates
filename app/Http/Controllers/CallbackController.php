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
            $order = null;

            switch ($type) {
                case 'order':
                    $order = Transaksi::where('payment_order_id', $callback->getNotification()->order_id)->first();
                    break;
            }

            if ($callback->isSuccess()) {
                if ($order) {
                    Transaksi::where('id', $order->id)->update([
                        'status' => 'selesai',
                    ]);
                }
            }

            if ($callback->isPending()) {
                if ($order) {
                    Transaksi::where('id', $order->id)->update([
                        'status' => 'pending',
                    ]);
                }
            }

            if ($callback->isExpire()) {
                if ($order) {
                    Transaksi::where('id', $order->id)->update([
                        'status' => 'gagal',
                    ]);
                }
            }

            if ($callback->isCancelled()) {
                if ($order) {
                    Transaksi::where('id', $order->id)->update([
                        'status' => 'gagal',
                    ]);

                }
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification successfully processed',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }
}
