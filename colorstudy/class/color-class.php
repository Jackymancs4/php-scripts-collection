<?php

class Color
{
    public function rand_color()
    {
        return array(rand(0, 255), rand(0, 255), rand(0, 255));
    }

    public function single_conf_color($firstcolor, $secondcolor, $step = 1, $max = 256)
    {
        $stop = false;
        $result = array();
        $i = 0;

        $result[] = $firstcolor;
        while ($i < $max && $stop == false) {
            if ($firstcolor < $secondcolor) {
                $firstcolor = $firstcolor + $step;
            } else {
                $firstcolor = $firstcolor - $step;
            }

            $result[] = round($firstcolor);

            if ($i == $max - 1 && $firstcolor <= ($secondcolor - $step) && $firstcolor >= ($secondcolor + $step)) {
                $stop = true;
            }

            ++$i;
        }
        $result[] = $secondcolor;

        return $result;
    }

    public function conf_color($firstcolor, $secondcolor)
    {
        $i = 0;
        $stop = false;
        $result = array();

        $result[][0] = $this->string_rgb($firstcolor);

        while ($i <= 255 && $stop == false) {
            if ($firstcolor[0] < $secondcolor[0]) {
                ++$firstcolor[0];
            } elseif ($firstcolor[0] > $secondcolor[0]) {
                --$firstcolor[0];
            }

            if ($firstcolor[1] < $secondcolor[1]) {
                ++$firstcolor[1];
            } elseif ($firstcolor[1] > $secondcolor[1]) {
                --$firstcolor[1];
            }

            if ($firstcolor[2] < $secondcolor[2]) {
                ++$firstcolor[2];
            } elseif ($firstcolor[2] > $secondcolor[2]) {
                --$firstcolor[2];
            }
            $result[][0] = $this->string_rgb($firstcolor);

            if ($firstcolor[0] == $secondcolor[0] && $firstcolor[1] == $secondcolor[1] && $firstcolor[2] == $secondcolor[2]) {
                $stop = true;
            }
            ++$i;
        }
        $result[][0] = $this->string_rgb($secondcolor);

        return $result;
    }

    public function string_rgb($color)
    {
        return $color[0].','.$color[1].','.$color[2];
    }

    public function scale($grad, $gmin, $gmax, $min = 0, $max = 255)
    {
        return floor((($max - $min) / ($gmax - $gmin)) * ($grad - $gmin) + $min);
    }

    public function rgb($grad, $minparam = 0, $maxparam = 255)
    {
        if ($grad > 360) {
            $grad = $grad % 360;
        }
        if ($grad < 0) {
            $grad += 360;
        }

        if ($grad >= 0 && $grad <= 60) {
            $R = $maxparam;
            $G = $this->scale($grad, 0, 60);
            $B = $minparam;
        }
        if ($grad > 60 && $grad <= 120) {
            $G = $maxparam;
            $R = $this->scale($grad, 60, 120, 255, 0);
            $B = $minparam;
        }
        if ($grad > 120 && $grad <= 180) {
            $G = $maxparam;
            $B = $this->scale($grad, 120, 180);
            $R = $minparam;
        }
        if ($grad > 180 && $grad <= 240) {
            $R = $minparam;
            $G = $this->scale($grad, 180, 240, 255, 0);
            $B = $maxparam;
        }
        if ($grad > 240 && $grad <= 300) {
            $B = $maxparam;
            $R = $this->scale($grad, 240, 300);
            $G = $minparam;
        }
        if ($grad > 300 && $grad <= 360) {
            $R = $maxparam;
            $B = $this->scale($grad, 300, 360, 255, 0);
            $G = $minparam;
        }

        return $R.','."$G".','.$B;
    }
}
