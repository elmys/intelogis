<?php

namespace elmys\intelogis\services;

use elmys\intelogis\adapters\SlowDeliveryCreator;
use elmys\intelogis\components\DeliveryService;

class SlowDelivery
{
    public $tariffs = [
        'msk' => [
            'izh' => [
                'koef' => 1.25,
                'period' => 2,
            ],
            'kzn' => [
                'koef' => 1.05,
                'period' => 1,
            ],
        ],
        'izh' => [
            'msk' => [
                'koef' => 1.25,
                'period' => 2,
            ],
            'kzn' => [
                'koef' => 1.05,
                'period' => 1,
            ],
        ],
        'kzn' => [
            'msk' => [
                'koef' => 1.25,
                'period' => 1,
            ],
            'izh' => [
                'koef' => 0.45,
                'period' => 1,
            ],
        ],
    ];

    public $basePrice = 150;
    public $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function legacyCalc(): string
    {
        $coefficient = 0;
        $sPeriod = '';
        $error = '';

        try {
            if(isset($this->tariffs[$this->params['sourceKladr']]) && $tariff = $this->tariffs[$this->params['sourceKladr']]){
                if(isset($tariff[$this->params['targetKladr']]) && $tariffFinish = $tariff[$this->params['targetKladr']]){
                    $coefficient = $tariffFinish['koef'];
                    $period = new \DateTime();
                    $period->modify('+' . $tariffFinish['period'] . ' day');
                    $sPeriod = $period->format('Y-m-d');
                }else{
                    $error = 'Not found destinate kladr on tariff';
                }
            }else{
                $error = 'Not found target kladr on tariff';
            }
        }catch(\Exception $e){
            $error = $e->getMessage();
        }

        $res = [
            'coefficient' => $coefficient,
            'period' => $sPeriod, // тут можно было в исходной тарифной сетке прописать даты, но, я думаю так интереснее, тем более то, что сервис следует формату ТЗ
            'error' => $error,
        ];
        return json_encode($res);
    }
}
