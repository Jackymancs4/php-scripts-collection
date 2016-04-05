<?php

$matrix1[] = array(1, -1, 0);
$matrix1[] = array(1, 2, 0);
$matrix1[] = array(0, 6, -4);

$matrix2[] = array(1, -1, 0);
$matrix2[] = array(1, 2, 1);
$matrix2[] = array(0, 6, -4);

include 'class/matrix-class.php';

$mat = new Matrix();

$mat->printM($matrix1);
echo '<br>';
$mat->printM($matrix2);
echo '<br>';
$matrix = $mat->product($matrix1, $matrix2);
$mat->printM($matrix);
echo '<br>';
