<?php

use Harrygr\Shipper\Location\Location;

class LocationTest extends PHPUnit_Framework_TestCase
{
    private $attributes = ['address1' => '123 Acacia Avenue', 'city' => 'London', 'country' => 'UK', 'postcode' => 'EC13 4AE'];

    /** @test **/
    public function it_allows_creating_a_location()
    {
        $location = new Location($this->attributes);
        $this->assertInstanceOf(Location::class, $location);
    }
}
