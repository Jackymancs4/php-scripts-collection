<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

include 'Statistics_class.php';

$stat = new Dice();

$n = 6;
$repeat = 100000;
$multi = 1;

$index = $stat->set($multi);

  echo '<br> Estrazioni: '.$repeat.'<br>';

  $total = 0;
  $var = 0;

  foreach ($index as $key => $value) {
      echo 'Numero: '.($key + $multi).' - Estrazioni: '.$value.' - Percentuale: '.($value / $repeat * 100).' - Approssimazione: '.round($value / $repeat * 100, 2).'<br>';
      $total += $value;

      $var += (($value / $repeat * 100) - (1 / $n * 100)) * (($value / $repeat * 100) - (1 / $n * 100));
    //echo "<br>".$var."<br>";
  }

  $var = $var / ($n - 1);
  echo '<br>';
  echo 'Varianza: '.$var;
  echo '<br>';
  echo "Probabilita' per numero: 1/".($n * $multi)." - Probabilita' percentuale: ".(1 / ($n * $multi) * 100).' - Approsimazione: '.round(1 / ($n * $multi) * 100, 2).'<br>';
  echo 'Totale estrazioni: '.$total;
