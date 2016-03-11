<?php

use Harrygr\Shipper\Weight\Unit;

class UnitTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_sets_the_unit()
    {
        $unit = new Unit('kg');
        $this->assertEquals('kg', (string) $unit);

        $unit = new Unit('gram');
        $this->assertEquals('g', (string) $unit);

        $unit = new Unit('grams');
        $this->assertEquals('g', (string) $unit);

        $unit = new Unit('Kilograms');
        $this->assertEquals('kg', (string) $unit);
    }

    /** @test **/
    public function it_gets_the_value_for_a_unit()
    {
        $unit = new Unit('g');
        $this->assertEquals(1, $unit->value());

        $unit = new Unit('kg');
        $this->assertEquals(1000, $unit->value());
    }

    /** @test **/
    public function it_takes_exception_to_an_unrecognised_unit()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $unit = new Unit('zz');
    }
}
