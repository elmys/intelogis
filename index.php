<?php

namespace elmys\intelogist;

use elmys\intelogist\services\FastDeliveryCreator;

require_once __DIR__  . '/vendor/autoload.php';

$d1 = new FastDeliveryCreator('');
echo $d1->calcDeliveryCost();