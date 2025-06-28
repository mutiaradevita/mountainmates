<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class CreateSnapTokenService extends Midtrans
{
    protected $request;

    public function __construct($request)
    {
        parent::__construct();

        $this->request = $request;
    }

    public function getSnapToken()
    {
        // Ambil order dari DB jika ada, untuk payment_token_created_at dan payment_token_expired_at
        
        $transaksi = Transaksi::where('payment_order_id', $this->request->order_id)->first();

        $itemDetails = [];
        foreach ($this->request->items ?? [] as $item) {
            $itemDetails[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        }
        
        $startTime = now();

        $params = [
            'transaction_details' => [
                'order_id' => $this->request->order_id,
                'gross_amount' => $this->request->gross_amount,
            ],
            'customer_details' => [
                'first_name' => $this->request->first_name,
                'email' => $this->request->email,
                'phone' => $this->request->phone,
            ],
            // 'item_details' => $itemDetails,
            'expiry' => [
                'start_time' => $startTime->format('Y-m-d H:i:s O'),
                'unit' => 'day',
                'duration' => 1,
            ],
        ];

        // dd($params);
        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Throwable $e) {
            Log::error('Midtrans SnapToken error: ' . $e->getMessage(), [
                'params' => $params,
                'exception' => $e,
            ]);
            throw $e;
        }

        return $snapToken;
    } 
}