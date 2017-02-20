<?php

namespace Vadim\UnitExamples;

class SimpleCalculator
{
    /**
     * @param int|float $a
     * @param int|float $b
     *
     * @return int|float
     */
    public function add($a, $b)
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \InvalidArgumentException('Arguments is invalid.');
        }

        return $a + $b;
    }
}
