<?php


include 'class/derivate-class.php';

$der = new Derivate();

$one = $der->ruler('4*x^3', 'x');
echo $der->parse($one, 'x');
