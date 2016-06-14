<?php

include 'Statistics_class.php';

$stat = new Statistics();
$report = $stat->run();

echo "<br>Probabilita': ".$stat->prob.' / Campioni: '.$stat->repeat;
echo '<br>Riusciti: '.count($report).' / Tasso: '.(count($report) / $stat->repeat * 100).'% / Tasso approssimato: '.round(count($report) / $stat->repeat * 100).'%';
echo '<br>';
echo '<br>';
echo '<br>';
