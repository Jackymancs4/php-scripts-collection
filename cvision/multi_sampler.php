<?php

ini_set('memory_limit', '512M');
set_time_limit(0);

include 'class/cv-class.php';

if (isset($_GET['threshold'])) {
    $threshold = $_GET['threshold'];
} else {
    $threshold = 50;
}

$cv = new CV();

$cv->load('file/bbb.jpg');
$cv->multi_sampler($threshold);
$cv->return_image();
