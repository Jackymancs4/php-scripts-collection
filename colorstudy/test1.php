<?php

include 'class/color-class.php';
include 'class/color-int-class.php';
include 'class/color-exp-class.php';

$color = new ColorExperiment();

$fistcolor = $color->rand_color();
$secondcolor = $color->rand_color();

$color->print_table($color->gradient(500, $fistcolor, $secondcolor), 1, 250);
echo '<br>';
$color->print_table($color->conf_color($fistcolor, $secondcolor), 1, 250);

?> 
