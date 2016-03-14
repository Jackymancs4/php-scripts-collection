<?php
$matrix[0][]=1;
$matrix[0][]=2;
$matrix[0][]=3;
$matrix[1][]=4;
$matrix[1][]=5;
$matrix[1][]=6;
$matrix[2][]=7;
$matrix[2][]=8;
$matrix[2][]=9;

include("class/matrix-class.php");

$mat=new Matrix();

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
echo "<br>";
$matrix=$mat->Gauss($matrix);
$mat->printM($matrix);
echo "<br>";
$matrix=$mat->GaussJordan($matrix);
$mat->printM($matrix);



?>