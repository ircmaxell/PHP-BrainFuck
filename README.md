PHP-BrainFuck
=============

A brainfuck interpreter for PHP

This repository goes along with my blog post: [The Brain Is A Muscle](http://blog.ircmaxell.com/2012/12/the-brain-is-muscle.html).

It also is result of this YouTube video: [BrainFuck Implementation In PHP](https://www.outube.com/watch?v=s3CncuzRzFA)

## Install
Install PHP-BrainFuck using [Composer](http://getcomposer.org/)
```
php composer.phar require ircmaxell/php-brain-fuck
```

## Usage

```php
<?php
// require_once 'vendor/autoload.php';

$Language = new Language;

$output = $Language->run('++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.');
var_dump($t);
```

Output:
<pre class='xdebug-var-dump' dir='ltr'>
<b>array</b> <i>(size=13)</i>
  0 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>72</font>
  1 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>101</font>
  2 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>108</font>
  3 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>108</font>
  4 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>111</font>
  5 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>32</font>
  6 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>87</font>
  7 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>111</font>
  8 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>114</font>
  9 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>108</font>
  10 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>100</font>
  11 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>33</font>
  12 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>10</font>
</pre>

```php
<?php
// require_once 'vendor/autoload.php';

$output = $Language->run(',+.', array(5));
var_dump($t);
```

Output:
<pre class='xdebug-var-dump' dir='ltr'>
<b>array</b> <i>(size=1)</i>
  0 <font color='#888a85'>=&gt;</font> <small>int</small> <font color='#4e9a06'>6</font>
</pre>