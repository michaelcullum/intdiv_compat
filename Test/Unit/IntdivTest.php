<?php

class IntdivTest extends PHPUnit_Framework_TestCase
{
    public function testCleanDivision()
    {
        $this->assertEquals(2, intdiv(6, 3));
        $this->assertTrue(is_int(intdiv(6,3)));
    }

    public function testNegativeDivision()
    {
        $this->assertEquals(-2, intdiv(-6, 3));
    }

    public function testUncleanDivision()
    {
        $this->assertEquals(3, intdiv(7, 2));
    }

    /**
     * @expectedException TypeError
     */
    public function testFloatDividend()
    {
        intdiv(6.5, 3);
    }

    /**
     * @expectedException TypeError
     */
    public function testFloatDivisor()
    {
        intdiv(6, 3.5);
    }

    /**
     * @expectedException DivisionByZeroError
     */
    public function testDivisionByZero()
    {
        intdiv(10, 0);
    }

    /**
     * @expectedException ArithmeticError
     */
    public function testSmallestNumber()
    {
        intdiv(~PHP_INT_MAX, -1);
    }
}