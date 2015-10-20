<?php
/**
 * A polyfill library with PHP 7's improved way of doing integer division
 *
 * @author Michael Cullum <m@michaelcullum.com>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2015 Michael Cullum
 */

namespace {
    if (!function_exists('intdiv')) {
        function intdiv($dividend, $divisor)
        {
            $dividend = (int) $dividend;
            $divisor = (int) $divisor;

            if ($divisor === 0) {
                throw new DivisionByZeroError('Division by zero');
            }

            if ($divisor === -1 && $dividend == ~PHP_INT_MAX) {
                throw new ArithmeticError('Division of PHP_INT_MIN by -1 is not an integer');
            }

            $dividend = ($dividend - $dividend % $divisor);

            return ((int) ($dividend / $divisor));
        }
    }

    if (!class_exists('ArithmeticError') || !class_exists('DivisionByZeroError')) {
        if (!interface_exists('Throwable')) {
            interface Throwable
            {
                public function getMessage();
                public function getCode();
                public function getFile();
                public function getLine();
                public function getTrace();
                public function getTraceAsString();
                public function getPrevious();
                public function __toString();
            }
        }

        if (!class_exists('Error')) {
            class Error extends \Exception implements \Throwable
            {
                public function __toString()
                {
                    return $this->getMessage();
                }
            }
        }

        if (!class_exists('ArithmeticError')) {
            class ArithmeticError extends \Error
            {
                public function __toString()
                {
                    return $this->getMessage();
                }
            }
        }

        if (!class_exists('DivisionByZeroError')) {
            class DivisionByZeroError extends \Error
            {
                public function __toString()
                {
                    return $this->getMessage();
                }
            }
        }
    }

    foreach (array('Error', 'ArithmeticError', 'DivisionByZeroError') as $class) {
        if (!$class instanceof \Exception || !$class instanceof \Throwable) {
            throw new \RuntimeException('A class named \''.$class.'\' is already defined that cannot be thrown.');
        }
    }
}
