<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

include 'Statistics_class.php';

$stat = new Statistics();

$n = 6;
$repeat = 1000000;

  for ($i = 0; $i < $n; ++$i) {
      $index[$i] = 0;
  }

  for ($h = 0; $h < $repeat; ++$h) {
      $c = $n;

      for ($i = 0; $i < $n; ++$i) {
          $pro = 1 / $c * 100;
          $report = $stat->check($pro, 100);
          if ($report != false) {
              //echo "".($i+1)."";
        ++$index[$i];
              break;
          }
          --$c;
      }
  }

  echo '<br>';

  $total = 0;
  $var = 0;

  foreach ($index as $key => $value) {
      echo 'Numero: '.($key + 1).' - Estrazioni: '.$value.' - Percentuale: '.($value / $repeat * 100).' - Approssimazione: '.round($value / $repeat * 100, 2).'<br>';
      $total += $value;

      $var += (($value / $repeat * 100) - (1 / $n * 100)) * (($value / $repeat * 100) - (1 / $n * 100));
    //echo "<br>".$var."<br>";
  }

  $var = $var / ($n - 1);
  echo '<br>';
  echo 'Varianza: '.$var;
  echo '<br>';
  echo "Probabilita' per numero: 1/".$n." - Probabilita' percentuale: ".(1 / $n * 100).' - Approsimazione: '.round(1 / $n * 100, 2).'<br>';
  echo 'Totale estrazioni: '.$total;
