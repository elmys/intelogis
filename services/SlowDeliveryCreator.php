<?php

namespace elmys\intelogis\services;

use elmys\intelogis\components\DeliveryService;
use elmys\intelogis\Creator;

class SlowDeliveryCreator extends Creator
{
    public function __construct(array $params)
    {
        foreach ($params as $name => $param) {
            if(property_exists($this, $name)){
                $this->$name = $param;
            }
        }
    }

    public function getDeliveryService(): DeliveryService
    {
        return new SlowDelivery($this);
    }
}