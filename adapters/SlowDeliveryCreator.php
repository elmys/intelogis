<?php

namespace elmys\intelogis\adapters;

use elmys\intelogis\components\DeliveryService;
use elmys\intelogis\Creator;
use elmys\intelogis\services\SlowDelivery;

class SlowDeliveryCreator extends Creator implements DeliveryService
{
    public $package;

    public function __construct(array $package)
    {
        $this->package = $package;
    }

    public function getDeliveryService() :SlowDelivery
    {
        return new SlowDelivery($this->package);
    }

    public function mainCalculate(): string
    {
        $delivery = $this->getDeliveryService();
        $importData = json_decode($delivery->legacyCalc(), true);

        $res = [
            'price' => number_format($importData['coefficient'] * $delivery->basePrice),
            'date' => $importData['period'],
            'error' => $importData['error'],
        ];
        return json_encode($res);
    }
}