<?php

class Statistics
{
    public $repeat = 10000;
    public $prob = 1;

    public function check($prob = false, $appro = 1)
    {
        if ($prob == false) {
            $prob = $this->prob;
        }

        $prob = $prob * $appro;

        $random = mt_rand(1, (100 * $appro));

        if ($random <= $prob) {
            return $random;
        } else {
            return false;
        }
    }

    public function mcd($a, $b)
    {
        while ($b) {
            list($a, $b) = array($b, $a % $b);
        }

        return $a;
    }

    public function run($prob = false, $repeat = false, $appro = 1)
    {
        if ($prob == false) {
            $prob = $this->prob;
        }
        if ($repeat == false) {
            $repeat = $this->repeat;
        }

        $reports = null;
        for ($i = 0; $i < $repeat; ++$i) {
            $report = $this->check($prob, $appro);
            if ($report != false) {
                $reports[] = $report;
            }
        }

        return $reports;
    }

    public function sequence($seq)
    {
        $var = false;
        $count = 0;
        $seq[] = false;

  //print_r($seq);

  foreach ($seq as $el) {
      if ($var == $el) {
          ++$count;
      } else {
          $var = $el;
          if (isset($index[$count + 1])) {
              ++$index[$count + 1];
          } else {
              $index[$count + 1] = 1;
          }

          $count = 0;
      }
  }
        --$index[1];

        return $index;
    }

    public function Statistics($prob = false, $repeat = false)
    {
        if ($prob != false) {
            $this->prob = $prob;
        }
        if ($repeat != false) {
            $this->repeat = $repeat;
        }
    }
}

class Dice extends Statistics
{
    public $report;
    public $repeat;
    public $multi;

    public function validate_dist($vector, $unit = false)
    {
        if ($vector == false) {
            return false;
        }

        $a = $vector[0][2];

        foreach ($vector as $array) {
            if ($array[2] != $a) {
                $a = ($a * $array[2]) / $this->mcd($a, $array[2]);
            }
        }

        $summ = 0;

        for ($i = 0;$i < count($vector);++$i) {
            if ($vector[$i][2] != $a) {
                $b = $a / $vector[$i][2];
                $vector[$i][2] = $a;
                $vector[$i][1] = $b;
            }
            $summ += $vector[$i][1];
        }

        if ($summ != $a && $unit != false) {
            return false;
        }

        $index;

        $f = 0;
        $g = 0;

        for ($h = 0; $h < $a; ++$h) {
            if ($vector[$f][1] > $g) {
                $index[$h] = $vector[$f][0];
                ++$g;
            } else {
                $g = 0;
                ++$f;
                --$h;
            }
        }

        return $index;
    }

    public function launch($n, $dist = false)
    {
        $c = $n;
        $dist = $this->validate_dist($dist);

        for ($i = 0; $i < $n; ++$i) {
            $pro = 1 / $c * 100;
            $report = $this->check($pro, 10000);
            if ($report != false) {
                if ($dist == false) {
                    return $i;
                } else {
                    return $dist[$i];
                }
            }
            --$c;
        }

        return false;
    }

    public function set($multi = 1, $n = 6, $repeat = 100000, $dist = false)
    {
        $this->repeat = $repeat;
        $this->multi = $multi;

        for ($i = 0; $i < ($n * $multi - $multi + 1); ++$i) {
            $index[$i] = 0;
        }

        for ($h = 0; $h < $repeat; ++$h) {
            if ($multi == 1) {
                $f = $this->launch($n, $dist);
            } else {
                $f = $this->multilaunch($n, $multi);
            }
            ++$index[$f];
        }

        $this->report = $index;

        return $index;
    }

    public function multilaunch($n, $d)
    {
        $val = 0;

        for ($h = 0; $h < $d; ++$h) {
            $val += $this->launch($n);
        }

        return $val;
    }

    public function analize()
    {
        $freport[] = array('Numero', 'Estrazioni', 'Percentuale', 'Per. approssimata');

        foreach ($this->report as $key => $value) {
            $freport[] = array(($key + $this->multi - 1), $value, ($value / $this->repeat * 100), round($value / $this->repeat * 100, 2));
        }

        return $freport;
    }
}
