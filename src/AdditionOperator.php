<?php

namespace Vadim\UnitExamples;

class AdditionOperator implements OperatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '+';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $args)
    {
        return $args[0] + $args[1];
    }

    /**
     * @return int
     */
    public function arity()
    {
        return 2;
    }
}
