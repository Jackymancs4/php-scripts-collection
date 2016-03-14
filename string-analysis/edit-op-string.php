<?php

set_time_limit(0);
ini_set("memory_limit","256M");

include("class/distance-class.php");
include("class/minpath-class.php");
include("class/viewer-class.php");

$first="democrat";
$second="republican";

$leven=new LenvenDist;
$view=new viewer;

$dist = $leven->levenshtein_s($first, $second);
$mat = $leven->get_lev_mat();

echo levenshtein($first, $second)." - ".$dist;
echo "<br><br>";

$view->mat_print($mat);
echo "<br><br>";

$astar=new Astar($mat, "0-0");

$path=$astar->path_mat(strlen($first)."-".strlen($second)."-".$mat[strlen($first)][strlen($second)]);

$view->mat_print($path);

?>