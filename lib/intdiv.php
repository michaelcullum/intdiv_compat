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
            if ($divisor == 0) {
                throw new DivisionByZeroError('Divisor in intdiv() cannot be zero');
            }

            if ($divisor == -1 && $dividend == ~PHP_INT_MAX) {
                throw new ArithmeticError('You are trying to divide a number that is too small');
            }

            if (!is_int($dividend) || !is_int($divisor))
            {
                throw new TypeError('Both the dividend and divisor must be integers');
            }

            $dividend = ($dividend - $dividend % $divisor);

            return (intval($dividend / $divisor));
        }
    }

    if ((!class_exists('ArithmeticError') || !class_exists('DivisionByZeroError') || !class_exists('TypeError')) 
        && (!class_exists('Error') || (!in_array('Throwable', class_implements('Error')) && !in_array('Throwable', class_implements('Exception'))))) {
        class Error extends \Exception
        {
            public function __toString()
            {
                return $this->getMessage();
            }
        }
    }

    if (!class_exists('ArithmeticError')) {
        class ArithmeticError extends Error
        {
            public function __toString()
            {
                return $this->getMessage();
            }
        }
    }

    if (!class_exists('DivisionByZeroError')) {
        class DivisionByZeroError extends Error
        {
            public function __toString()
            {
                return $this->getMessage();
            }
        }
    }

    if (!class_exists('TypeError')) {
        class TypeError extends Error
        {
            public function __toString()
            {
                return $this->getMessage();
            }
        }
    }
}