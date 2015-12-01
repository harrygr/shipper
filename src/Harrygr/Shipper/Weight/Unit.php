<?php

namespace Harrygr\Shipper\Weight;

class Unit
{
    private $unit;

    const GRAM = 1;
    const KILOGRAM = 1000;
    const OUNCE = 28.349523125;
    const POUND = 453.59237;

    public static $units = [
    'g'  => [
        'long_name' => 'gram', 
        'value' => self::GRAM,
        'aliases'   => ['g', 'gram', 'grams', 'grammes'],
        ],
    'kg' => [
        'long_name' => 'kilogram', 
        'value' => self::KILOGRAM,
        'aliases'   => ['kg', 'kilogram', 'kilograms', 'kilogrammes'],
        ],
    'oz' => [
        'long_name' => 'ounce', 
        'value' => self::OUNCE,
        'aliases'   => ['oz', 'ounce', 'ounces'],
        ],
    'lb' => [
        'long_name' => 'pound', 
        'value' => self::POUND,
        'aliases'   => ['lb', 'lbs', 'pound', 'pounds'],
        ],
    ];

    public function __construct($unit)
    {
        $this->unit = $this->getUnitFromString($unit);
    }

    private function getUnitFromString($original_unit)
    {
        foreach (self::$units as $unit => $properties) {
            if (in_array($original_unit, $properties['aliases'])) {
                return $unit;
            }
        }

        throw new \InvalidArgumentException("Unit '{$original_unit}' not recognised");
    }

    public function value()
    {
        return self::$units[$this->unit]['value'];
    }

    public function __toString()
    {
        return $this->unit;
    }
}
