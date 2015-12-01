<?php

use Harrygr\Shipper\PackageItem;
use Harrygr\Shipper\Weight\Unit;
use Harrygr\Shipper\Weight\Weight;

class PackageItemTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_sets_the_attributes_of_a_package()
    {
        $attributes = [
            'weight' => new Weight(850, new Unit('g')),
            'value'  => 75,
        ];
        $item = new PackageItem($attributes);

        $this->assertEquals(850, $item->weight()->in('grams')->value());

        $this->assertEquals(75, $item->value());
    }
}
