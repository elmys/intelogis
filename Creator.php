<?php

namespace elmys\intelogist;

use elmys\intelogist\components\DeliveryService;

abstract class Creator
{
    public $base_url;
    public $sourceKladr; //кладр откуда везем
    public $targetKladr; //кладр куда везем
    public $weight; //вес отправления в кг

    abstract public function getDeliveryService(): DeliveryService;

    public function calcDeliveryCost(): float
    {
        $delivery = $this->getDeliveryService();
        return $delivery->calculate();
    }

}