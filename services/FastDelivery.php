<?php

namespace elmys\intelogist\services;

use elmys\intelogist\components\DeliveryService;

class FastDelivery implements DeliveryService
{

    public function testInit() :string
    {
        $res = [
            'price' => 0,
            'period' => 0,
            'error' => 0,
        ];
        return json_encode($res);
    }

    public function calculate(): float
    {
        // TODO: Implement calculate() method.
        return 0;
    }

}

/*@return json
{
    "price": float //стоимость
	"period": int //количество дней начиная с сегодняшнего, но после 18.00 заявки не принимаются.
	"error": string
}*/
