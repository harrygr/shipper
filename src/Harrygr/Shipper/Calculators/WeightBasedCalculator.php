<?php

namespace Harrygr\Shipper\Calculators;

use Harrygr\Shipper\Contracts\CalculatorContract;
use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;
use Harrygr\Shipper\Weight\Unit;

class WeightBasedCalculator implements CalculatorContract {

    private $base_rate;
    private $weight_rate;
    private $unit;

    public function __construct($attributes = [])
    {
        if (!isset($attributes['weight_rate'])) {
            throw new \InvalidArgumentException('Please supply a weight rate');
        }

        $this->base_rate = isset($attributes['base_rate']) ? $attributes['base_rate'] : 0;
        $this->weight_rate = $attributes['weight_rate'];
        $this->setUnit(isset($attributes['unit']) ? $attributes['unit'] : 'kg');
    }

    public function setUnit($unit)
    {
        if (!$unit instanceof Unit) {
            $unit = new Unit($unit);
        }
        $this->unit = $unit;
    }
    public function getRate(
        Location $origin = null, 
        Location $destination = null, 
        Package $package = null
    )
    {
        $weight = $package->weight();

        $weight_cost = $weight->in($this->unit)->value() * $this->weight_rate;

        return $this->base_rate + $weight_cost;
    }
}