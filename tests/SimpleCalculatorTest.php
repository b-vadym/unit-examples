<?php

namespace Tests\Vadim\UnitExamples;

use PHPUnit_Framework_TestCase;
use Vadim\UnitExamples\SimpleCalculator;
use VladaHejda\AssertException;

class SimpleCalculatorTest extends PHPUnit_Framework_TestCase
{
    use AssertException;

    public function testAdd()
    {
        // arrange
        $calculator = new SimpleCalculator();

        // act
        $result = $calculator->add(1, 2);

        // assert
        $this->assertSame(3, $result);
    }

    /**
     * @dataProvider calculatorDataProvider
     *
     * @param int|float $first
     * @param int|float $second
     * @param int|float $expectedResult
     */
    public function testAddWidthDataProvider($first, $second, $expectedResult)
    {
        $calculator = new SimpleCalculator();

        $result = $calculator->add($first, $second);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function calculatorDataProvider()
    {
        return [
            [1, 2, 3],
            [5, 5, 10],
        ];
    }

    /**
     * @dataProvider notValidParametersProvider
     * @expectedException \InvalidArgumentException
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfParametersIsNotNumeric($first, $second)
    {
        $calculator = new SimpleCalculator();
        $calculator->add($first, $second);
    }

    /**
     * @return array
     */
    public function notValidParametersProvider()
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

    /**
     * @dataProvider notValidParametersProvider
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfParametersIsNotNumericWidthMethod($first, $second)
    {
        $calculator = new SimpleCalculator();

        $this->expectException(\InvalidArgumentException::class);

        $calculator->add($first, $second);
    }

    /**
     * @dataProvider notValidParametersProvider
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfParametersIsNotNumericWidthAssert($first, $second)
    {
        $calculator = new SimpleCalculator();

        $test = function () use ($calculator, $first, $second) {
            $calculator->add($first, $second);
        };

        self::assertException($test, \InvalidArgumentException::class);
    }
}
