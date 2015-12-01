<?php

use Harrygr\Shipper\Calculators\WeightBasedCalculator;
use Harrygr\Shipper\Package;
use Harrygr\Shipper\PackageItem;
use Harrygr\Shipper\Weight\Unit;
use Harrygr\Shipper\Weight\Weight;

class WeightBasedCalculatorTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_calculates_the_rate_for_a_single_item()
    {
        $calculator = new WeightBasedCalculator([
            'base_rate' => 5,
            'weight_rate' => 2,
            'unit' => 'kg'
            ]);

        $package = new Package([
            new PackageItem(['weight' => new Weight(2000, new Unit('g'))])
            ]);

        $this->assertEquals(9, $calculator->getRate(null, null, $package));

    }

    /** @test **/
    public function it_calculates_the_rate_for_multiple_items()
    {
        $calculator = new WeightBasedCalculator([
            'base_rate' => 5,
            'weight_rate' => 2,
            'unit' => 'kg'
            ]);

        $package = new Package([
            new PackageItem(['weight' => new Weight(2000, new Unit('g'))]),
            new PackageItem(['weight' => new Weight(1.5, new Unit('kg'))]),
            ]);

        $this->assertEquals(12, $calculator->getRate(null, null, $package));
    }
}
