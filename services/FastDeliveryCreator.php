<?php

namespace elmys\intelogis\services;

use elmys\intelogis\components\DeliveryService;
use elmys\intelogis\Creator;

class FastDeliveryCreator extends Creator
{
    public function __construct(array $params)
    {
        foreach ($params as $name => $param) {
            $this->$name = $param;
        }

        //$this->platformCreator = StringHelper::basename(get_class($this));
    }

    public function getDeliveryService(): DeliveryService
    {
        return new FastDelivery();
    }
}