<?php

// return [
//     'serverKey' => env('MIDTRANS_SERVER_KEY'),
//     'isProduction' => env('MIDTRANS_IS_PRODUCTION'),
//     'isSanitized' => env('MIDTRANS_IS_SANITIZED'),
//     'is3ds' => env('MIDTRANS_IS_3DS'),
// ];

return [
    'mercant_id' => env('MIDTRANS_MERCHAT_ID'),
    'serverKey' => env('MIDTRANS_SERVER_KEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];
