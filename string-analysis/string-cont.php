<?php

//Check if a string can contain another one.

set_time_limit(0);
ini_set("memory_limit","256M");

//http://localhost:90/test/string-permutation/string-cont.php?first=giacomorossetto&second=matteo

include("class/string-cont-class.php");

$first=$_GET['first'];
$second=$_GET['second'];
    
echo "First string: <b>".$first."</b><br>";
echo "Second string: <b>".$second."</b><br>";
echo "<br>";

$SC = new StringCont($first, $second);

if ($SC->i_c()) {
  echo "The first string contains the second one";
  echo "<br>";
  echo "The remaining characters are: <b>".$SC->g_ds()."</b>";
} else {
  echo "The first string doesn't contain the second one";
}


?>