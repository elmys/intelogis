<?php

namespace elmys\intelogis\services;

use elmys\intelogis\components\DeliveryService;

class SlowDelivery implements DeliveryService
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

    public static $basePrice = 150;
    public $parentObj;

    public function __construct(SlowDeliveryCreator $obj)
    {
        $this->parentObj = $obj;
    }

    public function legacyCalc(): array
    {
        /*
         {
 	"coefficient": float //коэффициент (конечная цена есть произведение базовой стоимости и коэффициента)
 	"date": string //дата доставки в формате 2017-10-20
 	"error": string
}

         * */

        $res = [];
        $coefficient = 0;
        $sPeriod = '';
        $error = '';

        try {
            if(isset($this->tariffs[$this->parentObj->sourceKladr]) && $tariff = $this->tariffs[$this->parentObj->sourceKladr]){
                if(isset($tariff[$this->parentObj->targetKladr]) && $tariffFinish = $tariff[$this->parentObj->targetKladr]){
                    $coefficient = $tariffFinish['koef'];
                    $period = new \DateTime();
                    $period->modify('+' . $tariffFinish['period'] . ' day');
                    $sPeriod = $period->format('Y-m-d');
                }else{
                    $error = 'Not found finish tariff';
                }
            }else{
                $error = 'Not found tariff';
            }
        }catch(\Exception $e){
            $error = $e->getMessage();
        }

        $res = [
            'coefficient' => $coefficient,
            'period' => $sPeriod,
            'error' => $error,
        ];
        return $res;
    }

    public function calculate(): string
    {
        $b = $this->legacyCalc();
        return json_encode([
            'price' => 1.125,
            'date' => '2022-08-27',
            'error' => '',
        ]);
    }

}
