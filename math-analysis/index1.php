<?php

$matrix[] = array(1, -1, 0);
$matrix[] = array(1, 2, 0);
$matrix[] = array(0, 6, -4);

include 'class/matrix-class.php';

$mat = new Matrix();

/*
$mat->printM($matrix);
echo "<br>";
$mat->printM($mat->Scambia($matrix,1,2));
echo "<br>";
$mat->printM($mat->Moltiplica($matrix,1,3));
echo "<br>";
$matrix = $mat->$mat->Combina($matrix,1,2,-1/4);
*/

$mat->printM($matrix);
echo '<br>';
$matrix = $mat->Gauss($matrix);
$mat->printM($matrix);
echo '<br>';
$matrix = $mat->GaussJordan($matrix);
$mat->printM($matrix);
