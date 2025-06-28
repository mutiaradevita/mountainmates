<?php

namespace App\Http\Controllers\Midtrans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['message' => 'OK'], 200);
    }
}
