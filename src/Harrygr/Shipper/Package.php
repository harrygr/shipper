<?php

namespace Harrygr\Shipper;

use Harrygr\Shipper\PackageItem;
use Harrygr\Shipper\Weight\Unit;
use Harrygr\Shipper\Weight\Weight;

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

    /**
     * Get the total weight for a package of items
     * @param  Unit|string $unit The unit the weight should be in
     * @return Weight       
     */
    public function weight($unit = 'kg')
    {
        $total_weight = new Weight(0, $unit);

        foreach ($this->items as $item) {
            $total_weight->add($item->weight());
        }
        return $total_weight;
    }
}