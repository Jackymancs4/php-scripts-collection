<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

include 'Statistics_class.php';

$stat = new Dice();

$n = 6;
$repeat = 1000000;
$multi = 2;

$stat->set($multi, $n, $repeat);

$index = $stat->analize();

  echo '<br> Estrazioni: '.$repeat.'<br>';

  $total = 0;
  $var = 0;

  echo '<table>';

  foreach ($index as $key => $value) {
      echo '<tr><td>'.$value[0].'</td><td>'.$value[1].'</td><td>'.$value[2].'</td><td>'.$value[3].'</td></tr>';
      $total += $value[1];

      $var += (($value[1] / $repeat * 100) - (1 / $n * 100)) * (($value[1] / $repeat * 100) - (1 / $n * 100));
    //echo "<br>".$var."<br>";
  }
  echo '</table>';

  $var = $var / ($n - 1);
  echo '<br>';
  echo 'Varianza: '.$var;
  echo '<br>';
  echo 'Totale estrazioni: '.$total;
