<?php

namespace elmys\intelogist\services;

use elmys\intelogist\components\DeliveryService;
use elmys\intelogist\Creator;

class FastDeliveryCreator extends Creator
{
    public function __construct(string $url)
    {
        $this->base_url = $url;
        //$this->platformCreator = StringHelper::basename(get_class($this));
    }

    public function getDeliveryService(): DeliveryService
    {
        return new FastDelivery();
    }
}