<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

function factorial($num)
{
    $res = 1;
    for ($i = 1;$i <= $num;++$i) {
        $res = $res * $i;
    }

    return $res;
}

function permutation($input)
{
    $occurences = array_count_values($input);
    $parz = 1;
    foreach ($occurences as $fatt) {
        $parz *= factorial($fatt);
    }

    $final = factorial(count($input)) / $parz;

    return $final;
}

$input = $_GET['string'];

for ($i = 0; $i < strlen($input); ++$i) {
    $str_input[] = $input[$i];
}

$fatt = factorial(count($str_input));
$per = permutation($str_input);

echo 'Permutazioni con ripetizione (fattoriale): '.$fatt.'<br>';

echo 'Permutazioni senza ripetizione: '.$per.'<br><br>';

echo 'Differenza: '.($fatt - $per).'<br>';
echo 'Rapporto: '.($fatt / $per).'<br>';
