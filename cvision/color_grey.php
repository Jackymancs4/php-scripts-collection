<?php

ini_set('memory_limit', '512M');
set_time_limit(0);

include 'class/cv-class.php';

$cv = new CV();

$cv->load('file/bbb.jpg');
$cv->grey_image();
$cv->return_image();
