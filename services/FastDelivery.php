<?php

namespace elmys\intelogis\services;

use elmys\intelogis\components\DeliveryService;
use DateTime;

class FastDelivery
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

    private $workTimeBegin = '09:00:00';
    private $workTimeEnd = '18:00:00';

    public $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function anotherFastCalc(): string
    {
        $price = 0;
        $period = 0;
        $error = '';
        $workTime = false;

        // проверка допустимого времени приёма заявок
        $checkDate = new DateTime(date('H:i:s'));
        $w1 = new DateTime($this->workTimeBegin);
        $w2 = new DateTime($this->workTimeEnd);
        if (!in_array(date('N'), [6, 7]) && ($checkDate <= $w2 && $checkDate >= $w1)) {
            $workTime = true;
        }

        if($workTime){
            try {
                if(isset($this->tariffs[$this->params['sourceKladr']]) && $tariff = $this->tariffs[$this->params['sourceKladr']]){
                    if(isset($tariff[$this->params['targetKladr']]) && $tariffFinish = $tariff[$this->params['targetKladr']]){
                        $price = $tariffFinish['cost'];
                        $period = $tariffFinish['period'];
                    }else{
                        $error = 'Not found destinate kladr on tariff';
                    }
                }else{
                    $error = 'Not found target kladr on tariff';
                }
            }catch(\Exception $e){
                $error = $e->getMessage();
            }
        }else{
            $error = 'После '.$this->workTimeEnd.' заявки не принимаются';
        }

        $res = [
            'price' => number_format($price),
            'period' => $period,
            'error' => $error,
        ];
        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
