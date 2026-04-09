<?php

return [
    'email_report' => env('EMAIL_REPORT'),
    'email_report_from' => env('EMAIL_REPORT_FROM'),

    'place_to_pay' => [
        'url_base' => env('PLACE_TO_PAY_URL'),
        'login' => env('PLACE_TO_PAY_LOGIN'),
        'secret_key' => env('PLACE_TO_PAY_SECRETKEY'),
    ],
];
