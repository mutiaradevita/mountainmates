<?php

namespace App\Services\Midtrans;

use App\Models\Transaksi;
use Midtrans\Notification;
use App\Services\Midtrans\Midtrans;

class CallbackService extends Midtrans
{
    protected $notification;
    protected $type;
    protected $orderId;
    protected $grossAmount;
    protected $paymentMethod;
    protected $serverKey;

    public function __construct()
    {
        parent::__construct();

        $this->serverKey = config('midtrans.server_key');
        $this->_handleNotification();
    }

    public function isSignatureKeyVerified()
    {
        return $this->_createLocalSignatureKey() == $this->notification->signature_key;
    }

    public function isSuccess()
    {
        $statusCode = $this->notification->status_code;
        $transactionStatus = $this->notification->transaction_status;
        $fraudStatus = !empty($this->notification->fraud_status) ? ($this->notification->fraud_status == 'accept') : true;

        return $statusCode == 200 && $fraudStatus && ($transactionStatus == 'capture' || $transactionStatus == 'settlement');
    }

    public function isPending()
    {
        return $this->notification->transaction_status == 'pending';
    }

    public function isExpire()
    {
        return $this->notification->transaction_status == 'expire';
    }

    public function isCancelled()
    {
        return $this->notification->transaction_status == 'cancel';
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    protected function _createLocalSignatureKey()
    {
        $orderId = $this->orderId;
        $statusCode = $this->notification->status_code;
        $grossAmount = "{$this->grossAmount}.00";
        $serverKey = $this->serverKey;
        $input = "{$orderId}{$statusCode}{$grossAmount}{$serverKey}";
        $signature = openssl_digest($input, 'sha512');

        return $signature;
    }

    protected function _handleNotification()
    {
        $notification = new Notification();
        $orderId = $notification->order_id;

        $order = Transaksi::where('payment_order_id', $orderId)->first();

        $this->notification = $notification;
        $this->orderId = $orderId;
        $this->grossAmount = (int) $order->total;
        $this->type = 'order';
        $this->paymentMethod = $notification->payment_type;
    }
}
