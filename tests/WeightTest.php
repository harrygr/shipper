<?php 
use Harrygr\Shipper\Weight\Weight; 
use Harrygr\Shipper\Weight\Unit;

class WeightTest extends PHPUnit_Framework_TestCase 
{ 
    /** @test **/
    public function it_holds_a_weight_value_in_grams() 
    { 
        $grams = new Unit('g');

        $weight = new Weight(1000, $grams);
        $this->assertEquals(1000, $weight->value());
    } 

    /** @test **/
    public function it_converts_the_weight_to_a_different_unit() 
    { 
        $weight = new Weight(1500, new Unit('g'));
        $weight_in_kg = $weight->in(new Unit('kg'));

        $this->assertEquals(1.5, $weight_in_kg->value());
        $this->assertInstanceOf(Weight::class, $weight_in_kg);
        $this->assertInstanceOf(Unit::class, $weight_in_kg->unit());
    } 

  /** @test **/
    public function it_allows_a_string_to_be_used_as_the_conversion_unit() 
    {
       $weight = new Weight(1500, new Unit('g'));
       $weight_in_kg = $weight->in('kg');

       $this->assertEquals(1.5, $weight_in_kg->value());
       $this->assertInstanceOf(Weight::class, $weight_in_kg);
       $this->assertInstanceOf(Unit::class, $weight_in_kg->unit());
   } 
}
