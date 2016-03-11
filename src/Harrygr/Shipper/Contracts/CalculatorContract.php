<?php

namespace Harrygr\Shipper\Contracts;

use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;

interface CalculatorContract
{
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
    );
}
