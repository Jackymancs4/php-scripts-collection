<?php

$rep = 10000;
$win = 0;

for ($j = 0; $j < $rep; ++$j) {

    //0 -> capra chiusa
    //1 -> macchina chiusa
    //2 -> scelta dal concorrente
    //3 -> capra aperta
    //4 -> macchina scelta dal concorrente

    $doors = array(0, 0, 0);
    $car = mt_rand(1, 3);

    //echo $car."<br>";

    $doors[$car - 1] = 1;

    $select = mt_rand(1, 3);

    //echo $select."<br>";

    if ($doors[$select - 1] == 1) {
        $doors[$select - 1] = 4;
    } else {
        $doors[$select - 1] = 2;
    }

    $goat = mt_rand(1, 2);

    //echo $goat."<br>";

    $goats = array();
    foreach ($doors as $key => $value) {
        if ($value == 0) {
            $goats[] = $key;
        }
    }

    if (count($goats) > 1) {
        $doors[$goats[$goat - 1]] = 3;
    } else {
        $doors[$goats[0]] = 3;
    }

    //print_r($doors);

    if (in_array(2, $doors)) {
        ++$win;
    }
}

echo $win.'<br>';
echo $win / $rep;
