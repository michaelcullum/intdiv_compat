# intdiv_compat
This library/polyfill provides the intdiv function that was added in PHP 7: https://wiki.php.net/rfc/intdiv

## Requirements

Requires PHP 5.3.0 or later due to exceptions

## Installation

Either `require` the `src/intdiv.php` file or install using [Composer](https://getcomposer.org/)

  `composer require michaelc/intdiv-compat`
  
## Usage

  `int intdiv ( int $dividend , int $divisor )`

Returns the integer quotient of the division of dividend by divisor

If divisor is 0, a DivisionByZeroError exception is thrown. If the dividend is ~PHP_INT_MAX
(PHP_INT_MIN was introduced in PHP 7) and the divisor is -1, then an ArithmeticError exception
is thrown.

See http://php.net/manual/en/function.intdiv.php for more information

Please note, if you define \Error in userland and it does not extend either \Throwable (Built-in
PHP 7) or \Exception then an error will arise as the \Error class will be attempted to be redeclared.

If \Error exists and extends \Throwable or \Exception then we do not redeclare it. If \Error does not
exist or exists but does not extend \Throwable or \Exception, we declare it and extend \Exception.

This library can be safely included on a system running PHP 7 and it will not affect core PHP 7 `intdiv()` usage.

## Tests

To run tests:
```
  composer install
  vendor/bin/phpunit
```
