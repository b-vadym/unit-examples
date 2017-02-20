<?php

namespace Tests\Vadim\UnitExamples\Fixtures;

use Vadim\UnitExamples\OperatorInterface;

class ManualOperatorStub implements OperatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '/';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $args)
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function arity()
    {
        return 2;
    }
}
