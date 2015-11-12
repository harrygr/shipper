<?php 
namespace Harrygr\Shipper\Weight; 

class Weight { 

    private $value; 
    private $unit;

    public function __construct($value, $unit) 
    {
        $this->value = $value; 
        $this->setUnit($unit);
    }
    
    public function value() 
    { 
        return $this->value; 
    }

    public function unit() 
    { 
        return $this->unit; 
    }

    public function setUnit($unit)
    {
        if (!$unit instanceof Unit) { 
            $unit = new Unit($unit); 
        } 
        $this->unit = $unit;
        return $this;
    } 

    public function in($unit) 
    { 
        if (!$unit instanceof Unit) { 
            $unit = new Unit($unit); 
        } 
        $value = $this->convertValueToUnit($unit); 
        return new static($value, $unit); 
    }

    public function toUnit($unit) { 
        return $this->in($unit); 
    }

    public function add(Weight $weight)
    {
        $this->value += $weight->in($this->unit)->value();
    }

    protected function convertValueToUnit(Unit $unit) 
    { 
        // 5kg converted to g will go 5 * 1000 = 5000; 5000 / 1 = 5000g 
        // 500g converted to kg will go 500 * 1 = 500; 500 / 1000 = 0.5kg 
        // Convert the value to the base unit 
        $value = $this->value * $this->unit->value(); 
        //Convert the base value to the new unit 
        return $value / $unit->value(); 
    } 
}
