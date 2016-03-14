<?php

include("class/color-class.php");

$color=new Color();

echo "<table style=\"border-collapse:collapse\">";
for($i=0; $i<=360; $i++) {
 echo "<tr>";
  for($j=0; $j<=255; $j++) {
    if ($j==0) {
      echo "<td style=\"border:0; margin:0; padding:0;\"><div style=\"height:1px; width:50px; background-color:rgb(".$color->rgb($i,$j).");\"></div></td>";
    } else {
      echo "<td style=\"border:0; margin:0; padding:0;\"><div style=\"height:1px; width:1px; background-color:rgb(".$color->rgb($i,$j).");\"></div></td>";
    }
  }
  echo "</tr>";
}
echo "</table>";


?> 