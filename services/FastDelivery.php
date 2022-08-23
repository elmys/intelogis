<?php

namespace elmys\intelogis\services;

use elmys\intelogis\components\DeliveryService;

class FastDelivery implements DeliveryService
{

    public $tariffs = [
        'msk' => [
            'izh' => [
                'cost' => 225,
                'period' => 2,
            ],
            'kzn' => [
                'cost' => 205,
                'period' => 1,
            ],
        ],
        'izh' => [
            'msk' => [
                'cost' => 225,
                'period' => 2,
            ],
            'kzn' => [
                'cost' => 205,
                'period' => 1,
            ],
        ],
        'kzn' => [
            'msk' => [
                'cost' => 225,
                'period' => 1,
            ],
            'izh' => [
                'cost' => 85,
                'period' => 1,
            ],
        ],
    ];

    public function testInit() :string
    {
        $res = [
            'price' => 0,
            'period' => 0,
            'error' => 0,
        ];
        return json_encode($res);
    }

    public function calculate(): string
    {
        return json_encode([
            'price' => 450,
            'period' => 2,
            'error' => '',
        ]);
    }

}
