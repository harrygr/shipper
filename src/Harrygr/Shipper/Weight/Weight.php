<?php


namespace Harrygr\Shipper\Weight;

class Weight
{
    /**
     * @var int|string
     */
    private $value;

    /**
     * @var Unit
     */
    private $unit;

    /**
     * Make a new Weight instance.
     *
     * @param int|float   $value
     * @param Unit|string $unit
     */
    public function __construct($value, $unit)
    {
        $this->value = $value;
        $this->setUnit($unit);
    }

    /**
     * Get the numeric value of the weight.
     *
     * @return int|float
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get the unit of the weight.
     *
     * @return Unit
     */
    public function unit()
    {
        return $this->unit;
    }

    /**
     * Set the unit of the weight.
     *
     * @param Unit|string $unit
     */
    protected function setUnit($unit)
    {
        if (!$unit instanceof Unit) {
            $unit = new Unit($unit);
        }
        $this->unit = $unit;

        return $this;
    }

    /**
     * Convert the weight to a different unit.
     *
     * @param Unit|string $unit
     *
     * @return Weight
     */
    public function in($unit)
    {
        if (!$unit instanceof Unit) {
            $unit = new Unit($unit);
        }
        $value = $this->convertValueToUnit($unit);

        return new static($value, $unit);
    }

    /**
     * Alias of in().
     *
     * @param Unit|string $unit
     *
     * @return Weight
     */
    public function toUnit($unit)
    {
        return $this->in($unit);
    }

    /**
     * Add a weight to the current weight.
     *
     * @param Weight $weight
     */
    public function add(Weight $weight)
    {
        $this->value += $weight->in($this->unit)->value();

        return $this;
    }

    /**
     * Convert the value from the current instance's unit to the unit passed
     *         
     * @param  Unit  $unit The unit to convert to
     * 
     * @return float
     */
    protected function convertValueToUnit(Unit $unit)
    {
        // 5kg converted to g will go 5 * 1000 = 5000; 5000 / 1 = 5000g
        // 500g converted to kg will go 500 * 1 = 500; 500 / 1000 = 0.5kg
        // Convert the value to the base unit
        $value = $this->value * $this->unit->value();
        //Convert the base value to the new unit
        return $value / $unit->value();
    }

    public function __toString()
    {
        return sprintf('%s%s', $this->value, $this->unit);
    }
}
