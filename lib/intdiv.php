<?php
/**
 * A polyfill library with PHP 7's improved way of doing integer division
 *
 * @author Michael Cullum <m@michaelcullum.com>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2015 Michael Cullum
 */

namespace {
    if (!defined('PHP_INT_MIN')) {
        define('PHP_INT_MIN', ~PHP_INT_MAX);
    }

    if (!function_exists('intdiv')) {
        function intdiv($dividend, $divisor)
        {
            $dividend = (int) $dividend;
            $divisor = (int) $divisor;

            if ($divisor === 0) {
                throw new DivisionByZeroError('Division by zero');
            }

            if ($divisor === -1 && $dividend === PHP_INT_MIN) {
                throw new ArithmeticError('Division of PHP_INT_MIN by -1 is not an integer');
            }

            $dividend = ($dividend - $dividend % $divisor);

            return ((int) ($dividend / $divisor));
        }
    }

    if ((!class_exists('ArithmeticError') || !class_exists('DivisionByZeroError')) 
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
}
