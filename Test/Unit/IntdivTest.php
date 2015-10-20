<?php

class IntdivTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check: ext/standard/tests/math/intdiv.phpt
     */
    public function testUsingPhpSourceTests()
    {
        ob_start();

        var_dump(intdiv(3, 2));
        var_dump(intdiv(-3, 2));
        var_dump(intdiv(3, -2));
        var_dump(intdiv(-3, -2));
        var_dump(intdiv(PHP_INT_MAX, PHP_INT_MAX));
        var_dump(intdiv(~PHP_INT_MAX, ~PHP_INT_MAX));
        try {
            var_dump(intdiv(PHP_INT_MIN, -1));
        } catch (Throwable $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }
        try {
            var_dump(intdiv(1, 0));
        } catch (Throwable $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }

        $result = ob_get_contents();
        ob_end_clean();

        $expectedOutput = <<<EOT
int(1)
int(-1)
int(-1)
int(1)
int(1)
int(1)
Exception: Division of PHP_INT_MIN by -1 is not an integer
Exception: Division by zero
EOT;

        $this->assertEquals($expectedOutput, $result);
    }

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

    public function testFloatInput()
    {
        $this->assertEquals(2, intdiv(6.5, 3));
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
