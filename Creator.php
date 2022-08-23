<?php

namespace elmys\intelogis;

use elmys\intelogis\components\DeliveryService;

abstract class Creator
{
    public $base_url;
    public $sourceKladr; //кладр откуда везем
    public $targetKladr; //кладр куда везем
    public $weight; //вес отправления в кг

    abstract public function getDeliveryService();

    public function calcDeliveryCost(): string
    {
        return $this->mainCalculate();
    }
}