<?php

return [
    'order-count' => [
        'behaviour' => \App\Metrics\Behaviour\OrderMetricBehaviour::class,
    ],

    'cancelled-count' => [
        'behaviour' => \App\Metrics\Behaviour\CancelledMetricBehaviour::class,
    ],
];
