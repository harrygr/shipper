<?php

namespace Harrygr\Shipper\Contracts;

use Harrygr\Shipper\Location\Location;
use Harrygr\Shipper\Package;

interface CalculatorContract
{
    /**
     * Get the rate for shipping a package.
     *
     * @param Location|null $origin      [description]
     * @param Location|null $destination [description]
     * @param Package|null  $package     [description]
     *
     * @return [type] [description]
     */
    public function getRate(
        Location $origin = null,
        Location $destination = null,
        Package  $package = null
    );
}
