<?php

namespace App\Services\Midtrans;

use Illuminate\Support\Facades\Http;

class CheckTransactionStatusService
{
    protected $serverKey;
    protected $isProduction;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
    }

    public function checkStatus($orderId)
    {
        $baseUrl = $this->isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';
        $url = "{$baseUrl}{$orderId}/status";

        $authHeader = 'Basic ' . base64_encode("{$this->serverKey}:");

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $authHeader,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
