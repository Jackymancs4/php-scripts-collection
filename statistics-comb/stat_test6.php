<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

include 'Statistics_class.php';

$stat = new Dice();

$vector[] = array(2, 1, 36);
$vector[] = array(3, 2, 36);
$vector[] = array(4, 3, 36);
$vector[] = array(5, 4, 36);
$vector[] = array(6, 5, 36);
$vector[] = array(7, 1, 6);
$vector[] = array(8, 5, 36);
$vector[] = array(9, 4, 36);
$vector[] = array(10, 3, 36);
$vector[] = array(11, 2, 36);
$vector[] = array(12, 1, 36);

$n = 36;
$repeat = 1000000;

$stat->set(1, $n, $repeat, $vector);

$findex = $stat->analize();

  echo '<br> Estrazioni: '.$repeat.'<br>';

  $total = 0;
  $var = 0;

  echo '<table>';

  foreach ($findex as $key => $value) {
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
