<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_prod' => env('MIDTRANS_IS_PROD', false),
    'is_sanitized' => false,
    'is_3ds' => false
];
