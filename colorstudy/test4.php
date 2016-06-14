<?php

include 'class/color-class.php';

$ccolor = new Color();

$x = 255;
$y = 360;

$my_img = imagecreatetruecolor($x, $y);

$color = array();

for ($i = 0; $i <= $y; ++$i) {
    for ($j = $x; $j >= 0; --$j) {
        $rcolor = explode(',', $ccolor->rgb($i, 0, $j));

    //print_r($rcolor);

    $color[] = imagecolorallocate($my_img, $rcolor[0], $rcolor[1], $rcolor[2]);
        imagesetpixel($my_img, $j, $i, $color[count($color) - 1]);
    }
}

header('Content-Type: image/png');
imagepng($my_img);
