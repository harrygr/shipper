<?php

use Harrygr\Shipper\Calculators\FlatRateCalculator;

class FlatRateCalculatorTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_takes_exception_to_no_rate_being_supplied()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $calculator = new FlatRateCalculator();
    }

    /** @test **/
    public function it_calculates_the_shipping_rate()
    {
        $calculator = new FlatRateCalculator(['rate' => 15]);

        $this->assertEquals(15, $calculator->getRate());
    }
}
