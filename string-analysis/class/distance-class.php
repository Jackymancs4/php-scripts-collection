<?php

class LenvenDist
{
    private $lev_matrix = array();

    public function get_lev_mat()
    {
        return $this->lev_matrix;
    }

    public function get_lev_value()
    {
        return $this->lev_matrix[count($this->lev_matrix) - 1][count($this->lev_matrix[count($this->lev_matrix) - 1]) - 1];
    }

    public function minimun($a, $b, $c)
    {
        $min = $a;

        if ($b < $min) {
            $min = $b;
        }
        if ($c < $min) {
            $min = $c;
        }

        return $min;
    }

    public function levenshtein_s($first, $second)
    {
        $d = array();

        for ($i = 0; $i <= strlen($first); ++$i) {
            $d[$i][0] = $i;
        }
        for ($i = 0; $i <= strlen($second); ++$i) {
            $d[0][$i] = $i;
        }

        for ($i = 1; $i <= strlen($first); ++$i) {
            for ($j = 1; $j <= strlen($second); ++$j) {
                if ($first[$i - 1] == $second[$j - 1]) {
                    $cost = 0;
                } else {
                    $cost = 1;
                }
                $d[$i][$j] = $this->minimun($d[$i - 1][$j] + 1, $d[$i][$j - 1] + 1, $d[$i - 1][$j - 1] + $cost);
            }
        }

        $this->lev_matrix = $d;

        return $d[strlen($first)][strlen($second)];
    }
}
