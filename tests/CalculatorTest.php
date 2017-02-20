<?php

namespace Tests\Vadim\UnitExamples;

use PHPUnit_Framework_TestCase;
use Tests\Vadim\UnitExamples\Fixtures\ManualOperatorStub;
use Vadim\UnitExamples\Calculator;
use Vadim\UnitExamples\OperatorInterface;
use VladaHejda\AssertException;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    use AssertException;

    public function testExceptionIfOperatorIsNotSupportedWithManualStub()
    {
        $calculator = $this->createCalculator();
        $operator = new ManualOperatorStub();
        $calculator->addOperator($operator);

        $test = function () use ($calculator) {
            $calculator->execute('+', 1, 2);
        };

        self::assertException($test, \RuntimeException::class, null, "Operator '+' is not supported.");
    }

    public function testExceptionIfOperatorIsNotSupported()
    {
        $calculator = $this->createCalculator();
        /** @var OperatorInterface|\PHPUnit_Framework_MockObject_MockObject $operator */
        $operator = $this->getMockBuilder(OperatorInterface::class)->getMock();
        $operator->method('__toString')->willReturn('/');
        $calculator->addOperator($operator);

        $test = function () use ($calculator) {
            $calculator->execute('+', 1, 2);
        };

        self::assertException($test, \RuntimeException::class, null, "Operator '+' is not supported.");
    }

    public function testExceptionIfArityAndNumberOfArgumentsNotEqual()
    {
        $calculator = $this->createCalculator();
        $operator = $this->generateOperatorMock();
        $calculator->addOperator($operator);

        $test = function () use ($calculator) {
            $calculator->execute('/', 1);
        };

        self::assertException($test, \InvalidArgumentException::class, null, "Operator '/' expects exactly 2 arguments, but 1 provided.");
    }

    /**
     * @dataProvider invalidArgumentsProvider
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfArgumentsIsNotNumeric($first, $second)
    {
        $calculator = $this->createCalculator();
        /** @var OperatorInterface|\PHPUnit_Framework_MockObject_MockObject $operator */
        $operator = $this->generateOperatorMock();
        $calculator->addOperator($operator);

        $test = function () use ($calculator, $first, $second) {
          $calculator->execute('/', $first, $second);
        };

        self::assertException($test, \InvalidArgumentException::class, null, 'Arguments is invalid.');
    }

    /**
     * @return array
     */
    public function invalidArgumentsProvider()
    {
        return [
            [new \stdClass(), 1],
            [[123], 3],
            [new \DateTime(), 122],
            [1, new \stdClass()],
            [123, [3]],
            [null, 12],
            [12, null],
            ['', 1],
            [1, ''],
        ];
    }

    public function testCallableExecuteMethod()
    {
        $calculator = $this->createCalculator();
        $operator = $this->generateOperatorMock();
        $operator
            ->expects($this->once())
            ->method('execute')
            ->with($this->equalTo([1,2]))
            ->willReturn(2)
        ;
        $calculator->addOperator($operator);

        $result = $calculator->execute('/', 1, 2);

        $this->assertSame(2, $result);
    }
    /**
     * @return Calculator
     */
    private function createCalculator()
    {
        return new Calculator();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OperatorInterface
     */
    private function generateOperatorMock()
    {
        $operator = $this->getMockBuilder(OperatorInterface::class)->getMock();
        $operator->method('__toString')->willReturn('/');
        $operator->method('arity')->willReturn(2);

        return $operator;
    }
}
