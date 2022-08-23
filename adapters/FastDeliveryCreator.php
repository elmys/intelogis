<?php

namespace elmys\intelogis\adapters;

use elmys\intelogis\components\DeliveryService;
use elmys\intelogis\Creator;
use elmys\intelogis\services\FastDelivery;

class FastDeliveryCreator extends Creator implements DeliveryService
{
    public $package;

    public function __construct(array $package)
    {
        $this->package = $package;
    }

    public function getDeliveryService() :FastDelivery
    {
        return new FastDelivery($this->package);
    }

    public function mainCalculate(): string
    {
        $res = [];
        $delivery = $this->getDeliveryService();
        if($importData = json_decode($delivery->anotherFastCalc(), true)){
            $period = new \DateTime();
            $period->modify('+' . $importData['period'] . ' day');
            $sPeriod = $period->format('Y-m-d');

            $res = [
                'price' => $importData['price'],
                'date' => $sPeriod,
                'error' => $importData['error'],
            ];
        }

        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}