<?php

function rand_color()
{
    return array(rand(0, 255), rand(0, 255), rand(0, 255));
}

function conf_color($firstcolor, $secondcolor)
{
    $i = 0;
    $stop = false;

    while ($i <= 255 && $stop == false) {
        if ($firstcolor[0] < $secondcolor[0]) {
            ++$firstcolor[0];
        } else {
            --$firstcolor[0];
        }

        if ($firstcolor[1] < $secondcolor[1]) {
            ++$firstcolor[1];
        } else {
            --$firstcolor[1];
        }

        if ($firstcolor[2] < $secondcolor[2]) {
            ++$firstcolor[2];
        } else {
            --$firstcolor[2];
        }
        echo '<div style="background-color: rgb('.string_rgb($firstcolor).'); height: 5px; width: 500px;"></div>';

        if ($firstcolor[0] == $secondcolor[0] && $firstcolor[1] == $secondcolor[1] && $firstcolor[2] == $secondcolor[2]) {
            $stop = true;
        }
        ++$i;
    }
    echo '<div style="background-color: rgb('.string_rgb($secondcolor).'); height: 5px; width: 500px;"></div>';
}

function string_rgb($color)
{
    return $color[0].','.$color[1].','.$color[2];
}

conf_color(rand_color(), rand_color());

?>
