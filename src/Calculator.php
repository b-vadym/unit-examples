<?php

namespace Vadim\UnitExamples;

class Calculator
{
    /**
     * @var OperatorInterface[]
     */
    private $operators;

    public function __construct()
    {
        $this->operators = [];
    }

    /**
     * @param OperatorInterface $operator
     *
     * @return $this
     */
    public function addOperator(OperatorInterface $operator)
    {
        $this->operators[(string) $operator] = $operator;

        return $this;
    }

    /**
     * @param string $operatorName
     *
     * @return float|int
     */
    public function execute($operatorName)
    {
        if (!isset($this->operators[$operatorName])) {
            throw new \RuntimeException(sprintf("Operator '%s' is not supported.", $operatorName));
        }

        $operator = $this->operators[$operatorName];
        $args = array_slice(func_get_args(), 1);

        if (count($args) !== $operator->arity()) {
            throw new \InvalidArgumentException(sprintf(
                "Operator '%s' expects exactly %d arguments, but %d provided.",
                $operatorName,
                $operator->arity(),
                count($args)
            ));
        }

        foreach ($args as $arg) {
            if (!is_numeric($arg)) {
                throw new \InvalidArgumentException('Arguments is invalid.');
            }
        }

        return $operator->execute($args);
    }
}
