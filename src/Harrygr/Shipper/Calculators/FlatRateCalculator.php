<?php

namespace Harrygr\Shipper\Calculators;

use Harrygr\Shipper\Contracts\CalculatorContract;
use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;

class FlatRateCalculator implements CalculatorContract
{
    protected $rate;

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

    public function getRate(
        Location $origin = null,
        Location $destination = null,
        Package  $package = null
    ) {
        return $this->rate;
    }
}
