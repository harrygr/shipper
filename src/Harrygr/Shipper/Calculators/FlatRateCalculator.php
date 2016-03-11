<?php

namespace Harrygr\Shipper\Calculators;

use Harrygr\Shipper\Contracts\CalculatorContract;
use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;

class FlatRateCalculator implements CalculatorContract
{
    protected $rate;

    /**
     * Create a new Flat Rate Calculator Instance.
     *
     * @param array $attributes The attributes of the calculator
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($attributes = null)
    {
        if (is_numeric($attributes)) {
            $this->rate = $attributes;
        } elseif (isset($attributes['rate'])) {
            $this->rate = $attributes['rate'];
        } else {
            throw new \InvalidArgumentException('No rate supplied');
        }
    }

    /**
     * Get the current rate of shipping.
     *
     * @param Location|null $origin      The origin of the package
     * @param Location|null $destination The destination of the package
     * @param Package|null  $package     The package being sent
     *
     * @return float The shipping rate
     */
    public function getRate(
        Location $origin = null,
        Location $destination = null,
        Package  $package = null
    ) {
        return $this->rate;
    }
}
