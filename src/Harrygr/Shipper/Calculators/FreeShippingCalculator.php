<?php

namespace Harrygr\Shipper\Calculators;

use Harrygr\Shipper\Contracts\CalculatorContract;
use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;

class FreeShippingCalculator implements CalculatorContract
{
    public function getRate(
        Location $origin = null,
        Location $destination = null,
        Package $package = null
    ) {
        return 0;
    }
}
