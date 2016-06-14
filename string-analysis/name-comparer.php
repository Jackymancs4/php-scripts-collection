<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

include 'class/string-cont-class.php';
include 'pattern-online-match.php';

$file = 'file/list.xml';
$address = 'http://digilander.libero.it/gioer/nomimaschili.html';

if (file_exists($file)) {
    $list = get_file_list($file);
} else {
    $list = save_link_list($address, $file);
}

if (isset($_GET['stringauno'])) {
    $stringauno = $_GET['stringauno'];
} else {
    $stringauno = 'giacomorossetto';
}

if (!isset($_GET['showno'])) {
    $_GET['showno'] = false;
}

echo 'Nome originale: <b>'.$stringauno.'</b></br><br>';

$count = 0;
$i = 0;

foreach ($list as $nome) {
    $nome = strtolower($nome);
    $SC = new StringCont($stringauno, $nome);

    if ($SC->i_c()) {
        echo($i + 1).'. Nome: <b>'.$nome.'</b>';
        echo '<br>';
        echo "E' contenuto nel nome originale<br>";
        echo 'I caratteri avanzati sono: <b>'.$SC->g_ds().'</b><br>';
        echo '<br>';
        ++$count;
    } else {
        if (isset($_GET['showno']) && $_GET['showno'] == false) {
        } else {
            echo($i + 1).'. Nome: <b>'.$nome.'</b>';
            echo '<br>';
            echo "Non e' contenuto nel nome originale<br>";
            echo '<br>';
        }
    }
    ++$i;
}

echo 'Sono state trovate '.$count.' corrispondenze.<br>';
