<?php

include 'viewer-class.php';

class CommonPattern
{
    public function CommonPattern($first, $second, $print = false)
    {
        $first = $this->s_to_a($first);
        $second = $this->s_to_a($second);

        $rend = $this->check_pattern($first, $second);
        $rend = $this->rev_check($first, $second);

        if ($print == true) {
            $this->print_rend($first, $second, $rend);
        }

        return $rend;
    }

    public function s_to_a($string)
    {
        $array = array();
        $c = strlen($string);

        for ($i = 0; $i < $c; ++$i) {
            $array[$i] = $string[$i];
        }

        return $array;
    }

    public function reverse_array($array)
    {
        $c = count($array);
        $newarray = array();
        for ($i = 1; $i <= $c; ++$i) {
            $newarray[] = $array[$c - $i];
        }

        return $newarray;
    }

    public function rev_check($first, $second)
    {
        return $this->check_pattern($second, $first);
    }

    public function back_check($first, $second)
    {
        $first = $this->reverse_array($first);
        $second = $this->reverse_array($second);

        return $this->check_pattern($first, $second);
    }

    public function back_rev_check($first, $second)
    {
        $first = $this->reverse_array($first);
        $second = $this->reverse_array($second);

        return $this->rev_check($first, $second);
    }

    public function check_pattern($first, $second)
    {
        $vi = new viewer();

        $table = $this->table($first);

        $vi->mat_print($table);
        echo '<br>';

        $newtable = $this->sub_table($second, $table);

        $vi->mat_print($newtable);
        echo '<br>';

        $res = $this->eval_table($newtable);

        $vi->mat_print($res);
        echo '<br>';

        $rend = $this->render_table($res, $table);

        $vi->mat_print($rend);
        echo '<br>';

        return $rend;
    }

    public function print_rend($first, $second, $rend)
    {
        echo 'Le stringhe: <br>'.$first.'<br>'.$second.'<br>hanno in cumune:<br><br>';
        foreach ($rend as $value) {
            foreach ($value as $string) {
                echo $string;
            }
            echo '<br>';
        }
    }

    public function table($string)
    {
        $table = array();
        $c = count($string);
        for ($i = 0;$i < $c;++$i) {
            $table[$string[$i]][] = ($i + 1);
        }

        return $table;
    }

    public function sub_table($string, $table)
    {
        $newtable = array();
        $c = count($string);
        for ($i = 0; $i < $c; ++$i) {
            if (isset($table[$string[$i]])) {
                $newtable[] = $table[$string[$i]];
            }
        }

        return $newtable;
    }

    public function eval_table($table)
    {
        $res = array();
        $count_seq = 0;

        $repeat = true;

        $old = 0;
        $i = 0;

        $c = count($table);

        $vi = new viewer();

        while ($c > $i) {
            $stop = false;
            $d = count($table[$i]);
            $new = false;
            $zero = false;

            for ($j = 0; $j < $d && $stop == false; ++$j) {
                if ($table[$i][$j] != 0) {
                    $zero = true;
                    if (($table[$i][$j] > $old && ($old == 0 || $table[$i][$j] < ($old + 3)))) {
                        $old = $table[$i][$j];
                        $res[$count_seq][] = $table[$i][$j];
                        $table[$i][$j] = 0;
                        $stop = true;
                    }
                }
            }

            if ($zero == true && $stop == false) {
                $old = 0;
                ++$count_seq;
                $new = true;
            }

            if ($new == true) {
                $i = 0;
            } else {
                ++$i;
            }
        }

        return $res;
    }

    public function eval_table_old($table)
    {
        $c = count($table);
        $count = 0;
        $res = array();
        $old = array(0);
        $oldindex = 0;
        for ($i = 0; $i < $c; ++$i) {
            $stop = false;
            $d = count($table[$i]);
            $do = count($old);

            for ($h = 0; $h < $do && $stop == false; ++$h) {
                for ($j = 0; $j < $d && $stop == false; ++$j) {
                    if ($table[$i][$j] > $old[$h] && ($old[0] == 0 || $table[$i][$j] < ($old[$h] + 3))) {
                        if ($oldindex != $h) {
                            ++$count;
                            $res[$count][] = $old[$h];
                        }

                        $oldindex = $j;
                        $old = $table[$i];
                        $res[$count][] = $table[$i][$j];
                        $stop = true;
                    }
                }
            }
            if ($stop == false) {
                ++$count;
                $oldindex = 0;
                $old = $table[$i];
                $res[$count][] = $table[$i][0];
            }
        }

        return $res;
    }
    public function render_table($res, $table)
    {
        for ($i = 0; $i < count($res); ++$i) {
            for ($j = 0; $j < count($res[$i]); ++$j) {
                foreach ($table as $key => $value) {
                    if (in_array($res[$i][$j], $value)) {
                        $res[$i][$j] = $key;
                    }
                }
            }
        }

        return $res;
    }
}
