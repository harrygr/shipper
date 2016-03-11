<?php

namespace Harrygr\Shipper\Calculators;

use Harrygr\Shipper\Contracts\CalculatorContract;
use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;
use Harrygr\Shipper\Weight\Unit;

class WeightBasedCalculator implements CalculatorContract
{
    /**
     * The base (minimum) cost of shipping
     * @var float
     */
    private $base_rate;

    /**
     * The cost per unit weight
     * 
     * @var float
     */
    private $weight_rate;

    /**
     * The unit for which the weight rate applies
     * 
     * @var \Harrygr\Shipper\Weight\Unit
     */
    private $unit;

    /**
     * Create a new Weight Based Shipping Instance
     * 
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        if (!isset($attributes['weight_rate'])) {
            throw new \InvalidArgumentException('Please supply a weight rate');
        }

        $this->base_rate = isset($attributes['base_rate']) ? $attributes['base_rate'] : 0;
        $this->weight_rate = $attributes['weight_rate'];
        $this->setUnit(isset($attributes['unit']) ? $attributes['unit'] : 'kg');
    }

    /**
     * Set the unit for which the weight rate applies
     * 
     * @param \Harrygr\Shipper\Weight\Unit|string $unit [description]
     */
    public function setUnit($unit)
    {
        if (!$unit instanceof Unit) {
            $unit = new Unit($unit);
        }
        $this->unit = $unit;
    }

    /**
     * Get the current rate of shipping
     * 
     * @param  Location|null $origin      The origin of the package
     * @param  Location|null $destination The destination of the package
     * @param  Package|null  $package     The package being sent
     * 
     * @return float                      The shipping rate
     */
    public function getRate(
        Location $origin = null,
        Location $destination = null,
        Package $package = null
    ) {
        $weight = $package->weight();

        $weight_cost = $weight->in($this->unit)->value() * $this->weight_rate;

        return $this->base_rate + $weight_cost;
    }
}
