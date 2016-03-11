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
        'value'     => self::GRAM,
        'aliases'   => ['g', 'gram', 'grams', 'grammes'],
        ],
    'kg' => [
        'long_name' => 'kilogram',
        'value'     => self::KILOGRAM,
        'aliases'   => ['kg', 'kilogram', 'kilograms', 'kilogrammes'],
        ],
    'oz' => [
        'long_name' => 'ounce',
        'value'     => self::OUNCE,
        'aliases'   => ['oz', 'ounce', 'ounces'],
        ],
    'lb' => [
        'long_name' => 'pound',
        'value'     => self::POUND,
        'aliases'   => ['lb', 'lbs', 'pound', 'pounds'],
        ],
    ];

    /**
     * Create a new Unit instance.
     *
     * @param string $unit The unit of the instance
     */
    public function __construct($unit)
    {
        $this->unit = $this->getUnitFromString($unit);
    }

    /**
     * Derive the unit from a string.
     *
     * @param string $original_unit A string representation of a unit
     *
     * @return string
     */
    private function getUnitFromString($original_unit)
    {
        $original_unit = strtolower($original_unit);

        foreach (self::$units as $unit => $properties) {
            if (in_array($original_unit, $properties['aliases'])) {
                return $unit;
            }
        }

        throw new \InvalidArgumentException("Unit '{$original_unit}' not recognised");
    }

    /**
     * Get the converstion value of the unit.
     *
     * @return float
     */
    public function value()
    {
        return self::$units[$this->unit]['value'];
    }

    /**
     * Cast the instance to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->unit;
    }
}
