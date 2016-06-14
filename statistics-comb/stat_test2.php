<?php

include 'Statistics_class.php';

$pro = 1 / 6 * 100;

$stat = new Statistics($pro, 1000000);

$report = $stat->run();

echo "<br>Probabilita': ".$stat->prob.' / Campioni: '.$stat->repeat;
echo '<br>Riusciti: '.count($report).' / Tasso: '.(count($report) / $stat->repeat * 100).'% / Tasso approssimato: '.round(count($report) / $stat->repeat * 100).'%';
echo '<br>';
echo '<br>';
echo '<br>';
