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
				throw new Exception("Divisor in intdiv() cannot be zero");
			}

			if ($divisor == -1 && $dividend == PHP_INT_MIN) {
				throw new Exception('You are trying to divide a number that is too small');
			}

			$dividend = ($dividend - $dividend % $divisor);

			return (intval($dividend / $divisor));
		}
	}

	if (!class_exists('ArithmeticError') || !class_exists('DivisionByZeroError')) {
		class Error extends Exception
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