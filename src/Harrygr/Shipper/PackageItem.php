<?php

namespace Harrygr\Shipper;

use Harrygr\Shipper\Weight\Weight;

class PackageItem {
    protected $weight;
    protected $value;

    public function __construct($attributes = [])
    {
        $this->weight = isset($attributes['weight']) ? $attributes['weight'] : null;
        $this->value = isset($attributes['value']) ? $attributes['value'] : null;

    }

    /**
     * Set the weight of a package item
     * @param Weight $weight
     */
    function setWeight(Weight $weight)
    {
        $this->weight = $weight;
    }

    /**
     * Get the weight of a package item
     * @param Weight $weight
     */
    public function weight()
    {
        return $this->weight;
    }

    /**
     * Set the weight of a package item
     * @param $value
     */
    function setvalue($value)
    {
        $this->value = $value;
    }

    /**
     * Get the value of a package item
     * @param value $value
     */
    public function value()
    {
        return $this->value;
    }

}