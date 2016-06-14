<?php

function generateRandomString($length = 13)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; ++$i) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function getmicrotime()
{
    list($usec, $sec) = explode(' ', microtime());

    return (float) $usec + (float) $sec;
}

$time_start = getmicrotime();//sec iniziali
$time = 0;
$cont = 0;

while ($time < 30) {
    md5(generateRandomString());
  //generateRandomString();

$time_end = getmicrotime();//sec finali
$time = $time_end - $time_start;//differenza in secondi
++$cont;
}

echo '<br>'.$cont.' in '.$time.' secondi<br>';
