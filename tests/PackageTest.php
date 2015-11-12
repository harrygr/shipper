<?php

use Harrygr\Shipper\Package;
use Harrygr\Shipper\PackageItem;

class PackageTest extends PHPUnit_Framework_TestCase {

    /** @test **/
    public function it_makes_a_collection_of_items()
    {
        $items = array_fill(0, 3, new PackageItem);
        $package = new Package($items);

        $this->assertInstanceOf(Package::class, $package);
    }

    /** @test **/
    public function it_allows_adding_new_items()
    {
        $items = array_fill(0, 3, new PackageItem);
        $package = new Package($items);
        $package->addItem(new PackageItem);

        $this->assertEquals(4, $package->count());
    }

    /** @test **/
    public function it_counts_the_items_in_the_package()
    {
        $items = array_fill(0, 3, new PackageItem);
        $package = new Package($items);

        $this->assertEquals(3, $package->count());
    }

    /** @test **/
    public function it_calculates_the_total_package_value()
    {
        $items = [
            new PackageItem(['value' => 15]),
            new PackageItem(['value' => 30]),
        ];

        $package = new Package($items);
        $this->assertEquals(45, $package->value());
    }
}