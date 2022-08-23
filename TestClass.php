<?php
namespace elmys\intelogis;

use elmys\intelogis\adapters\FastDeliveryCreator;
use elmys\intelogis\adapters\SlowDeliveryCreator;

class TestClass
{
    public static $testPackages = [
        4334 => [
            'id' => 4334,
            'base_url' => 'aslkfjergformvoja',
            'sourceKladr' => 'msk',
            'targetKladr' => 'izh',
            'weight' => 12.6,
        ],
        3233 => [
            'id' => 3233,
            'base_url' => 'fselknjvgklnrlgrn',
            'sourceKladr' => 'kzn',
            'targetKladr' => 'spb',
            'weight' => 4.54,
        ],
        4465 => [
            'id' => 4465,
            'base_url' => 'frwgfregfhyjukukuy',
            'sourceKladr' => 'izh',
            'targetKladr' => 'kzn',
            'weight' => 1.53,
        ],
    ];

    public static function run() :void{
        foreach (self::$testPackages as $id => $packageData) {
            $delivery = new FastDeliveryCreator($packageData);
            var_dump($id.' - FastDelivery: ' . $delivery->calcDeliveryCost() . PHP_EOL);
        }

        echo '<hr>';

        foreach (self::$testPackages as $id => $packageData) {
            $delivery = new SlowDeliveryCreator($packageData);
            var_dump($id.' - SlowDelivery: ' . $delivery->calcDeliveryCost() . PHP_EOL);
        }
    }
}