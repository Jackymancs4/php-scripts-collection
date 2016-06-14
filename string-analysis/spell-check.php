<?php

    //MAI TERMINARE CON CONSONANTE

    //MASSIMO 3 CONSONANTI o 3 VOCALI DI SEGUITO
        //DI QUESTE NESSUNA DOPPIA

    //MAI DOPPIA VOCALE

    //MAI INIZIARE CON DOPPIA CONSONANTE

    set_time_limit(0);
    ini_set('memory_limit', '512M');

    include 'class/spell-class.php';

    //?string=test

    $input = $_GET['string'];

    $spell = new Spell();

    echo '1 '.$spell->rule_one($input).'<br>';
    echo '2 '.$spell->rule_two($input).'<br>';
    echo '3 '.$spell->rule_three($input).'<br>';
    echo '4 '.$spell->rule_four($input).'<br>';

    if ($spell->check($input)) {
        echo 'ok';
    } else {
        echo 'not';
    }
