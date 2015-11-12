<?php

namespace Harrygr\Shipper;

use Harrygr\Shipper\PackageItem;

class Package implements \Countable {
    /**
     * The items in the package
     * @var Array
     */
    private $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * Add an item to the package
     * @param PackageItem $item
     */
    public function addItem(PackageItem $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Get a count of the items in the package
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Get the total value of the items in the package
     * @return float|int
     */
    public function value()
    {
        return array_reduce($this->items, function($carry, $item) {
            return $carry + $item->value();
        });
    }

}