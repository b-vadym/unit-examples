<?php

namespace Vadim\UnitExamples;

interface OperatorInterface
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @param array $args
     *
     * @return int|float
     */
    public function execute(array $args);

    /**
     * @return int
     */
    public function arity();
}
