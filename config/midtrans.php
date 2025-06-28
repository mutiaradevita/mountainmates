<?php

return [
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'your-client-key-here'),
    'server_key' => env('MIDTRANS_SERVER_KEY', 'your-server-key-here'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    'snap_url' => env('MIDTRANS_SNAP_URL', 'https://app.sandbox.midtrans.com/snap/snap.js'),
];