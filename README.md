PHP-BrainFuck
=============

A brainfuck interpreter for PHP

This repository goes along with my blog post: [The Brain Is A Muscle](http://blog.ircmaxell.com/2012/12/the-brain-is-muscle.html).

It also is result of this YouTube video: [BrainFuck Implementation In PHP](https://www.youtube.com/watch?v=s3CncuzRzFA)

## Install
Install PHP-BrainFuck using [Composer](http://getcomposer.org/)
```
php composer.phar require ircmaxell/php-brain-fuck
```

## Usage

```php
<?php
// require_once 'vendor/autoload.php';

use BrainFuck\Language;

$Language = new Language;

$output = $Language->run('++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.');
var_dump($output);

// Output:
/*
array (size=13)
  0 => int 72
  1 => int 101
  2 => int 108
  3 => int 108
  4 => int 111
  5 => int 32
  6 => int 87
  7 => int 111
  8 => int 114
  9 => int 108
  10 => int 100
  11 => int 33
  12 => int 10
*/

$output = $Language->run(',+.', array(5));
var_dump($output);

// Output:
/*
array (size=1)
  0 => int 6
*/
```
