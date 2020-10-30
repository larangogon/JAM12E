<?php

return [
    'order-count' => [
        'behaviour' => \App\Metrics\Behaviour\OrderMetricBehaviour::class,
    ],

    'payment-count' => [
        'behaviour' => \App\Metrics\Behaviour\PaymentMetricBehaviour::class,
    ],

    'cancelled-count' => [
        'behaviour' => \App\Metrics\Behaviour\CancelledMetricBehaviour::class,
    ],
];