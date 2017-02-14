<?php

namespace Vadim\UnitExamples;

class AdditionOperator implements OperatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $args)
    {
        return $args[0] + $args[1];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '+';
    }

    /**
     * @return int
     */
    public function arity()
    {
        return 2;
    }
}
