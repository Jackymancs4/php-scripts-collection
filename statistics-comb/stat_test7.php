<?php

set_time_limit(0);
ini_set("memory_limit","256M");

include("Statistics_class.php");

$stat = new Dice();

$vector[] = array (2, 1, 36);
$vector[] = array (3, 2, 36);
$vector[] = array (4, 3, 36);
$vector[] = array (5, 4, 36);
$vector[] = array (6, 5, 36);
$vector[] = array (7, 1, 6);
$vector[] = array (8, 5, 36);
$vector[] = array (9, 4, 36);
$vector[] = array (10, 3, 36);
$vector[] = array (11, 2, 36);
$vector[] = array (12, 1, 36);


$n = 36;
$repeat=1000;

for($i=0;$i<$repeat;$i++){  
  $var=$stat->launch($n, $vector);  
  $index[]=$var;
  //echo $var."<br>";
}

echo "Cicli: ".$repeat."<br>"; 
echo "<table>";
echo "<tr><td>Lunghezza sequenze</td><td>Ripetizioni</td></tr>";

$total=0;

foreach($stat->sequence($index) as $key => $value) {
    
  echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
  $total+=($key*$value);
  
             
}
echo "</table>";

echo "Totale: ".$total;

?>
