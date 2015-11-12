<?php

use Harrygr\Shipper\Calculators\FreeShippingCalculator;

class FreeShippingCalculatorTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_returns_0_for_the_shipping_rate()
    {
        $calculator = new FreeShippingCalculator();

        $this->assertEquals(0, $calculator->getRate());
    }
}
