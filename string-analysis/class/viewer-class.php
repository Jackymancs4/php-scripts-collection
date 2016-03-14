<?php

class viewer {

  //add n-dimensional matrix print

  public function mat_print($mat){
    echo "<table>";
    foreach($mat as $ival) {
      echo "<tr>";
      foreach($ival as $jval) {
        echo "<td>".$jval."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  public function vet_print($vet) {
    echo "<table>";
    foreach ($vet as $val) {
      echo "<tr><td>".$val."</tr></td>";
    }
    echo "</table>";
  }

}
?>