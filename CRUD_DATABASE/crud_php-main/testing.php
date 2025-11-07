<?php

include_once('libraries/functions.php');

$dwes = new PDO('mysql:host=localhost;dbname=crud_mysql', 'crud_mysql', 'crud_mysql');


class Foo {
    public    $foo  = 1;
    protected $bar  = 2;
    private   $baz  = 3;
    public function firstMethod() { }
    final protected function secondMethod() { }
    private static function thirdMethod() { }
};


$foo = new Foo();
dump($foo);





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    
</body>
</html>