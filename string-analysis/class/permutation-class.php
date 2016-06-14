<?php

set_time_limit(0);
ini_set('memory_limit', '512M');

class Permutation
{
    public $stringa = array();
    public $appostringa = array();

    public function getmicrotime()
    {
        list($usec, $sec) = explode(' ', microtime());

        return (float) $usec + (float) $sec;
    }

    public function salva($string, $s_array, $i, $j, $n)
    {
        $appostringa = implode('-', $s_array);
        echo '<br><a href="index.php?load=true&stringa='.$string.'&appostringa='.$appostringa.'&i='.$i.'&j='.$j.'&n='.$n.'">Nuovo ciclo</a><br>';
    }

    private function copy_array($array)
    {
        for ($i = 0; $i <= count($array); ++$i) {
            $c_array[$i] = $i;
        }

        return $c_array;
    }

    private function swap($stringa, $i, $j)
    {
        $temp = $stringa[$i];
        $stringa[$i] = $stringa[$j];
        $stringa[$j] = $temp;

        return $stringa;
    }

    public function make_perm($stringa, $s_array, $autostop, $timelimit, $i = 1, $j = 0, $n = 0)
    {
        $time_start = $this->getmicrotime();
        $time = 0;
        $x = 0;

        $perm = array();

        while ($i < count($stringa)) {
            --$s_array[$i];
            $j = $i % 2 * $s_array[$i];
            $stringa = $this->swap($stringa, $j, $i);
            $i = 1;

            while ($s_array[$i] == 0) {
                $s_array[$i] = $i;
                ++$i;
            }

            $newstring = implode('', $stringa);

            $time_end = $this->getmicrotime();
            $time = $time_end - $time_start;
            if ($autostop == true && $time >= ($timelimit - 1)) {
                echo 'Sono state fatte '.$n.' permutazioni, di cui in questo ciclo '.$x.' in '.$time.' secondi.<br>';
        //$this->salva($newstring, $s_array, $i, $j, $n);
        break;
            }

            if (isset($perm[$newstring])) {
                ++$perm[$newstring];
            } else {
                $perm[$newstring] = 1;
            }

      //echo $newstring."<br>";
      //$perm[] = $newstring;
      //echo ($n+1)." - ".$newstring."<br>";

      ++$n;
            ++$x;
        }

    //print_r($perm);
    return $perm;
    }

    public function get_unique_perm($array)
    {
        return array_unique($array);
    }

    public function start_perm($autostop, $timelimit, $load = false, $unique = false)
    {
        if ($load == true) {
            $out = $this->make_perm($this->stringa, $this->appostringa, $autostop, $timelimit, $_GET['i'], $_GET['j'], $_GET['n']);
        } else {
            $out = $this->make_perm($this->stringa, $this->appostringa, $autostop, $timelimit);
        }

        if ($unique == true) {
            return $this->get_unique_perm($out);
        } else {
            return $out;
        }
    }

    public function factorial($num)
    {
        $res = 1;
        for ($i = 1;$i <= $num;++$i) {
            $res = $res * $i;
        }

        return $res;
    }

    public function count_permutation($input)
    {
        $occurences = array_count_values($input);
        $parz = 1;
        foreach ($occurences as $fatt) {
            $parz *= $this->factorial($fatt);
        }

        $final = $this->factorial(count($input)) / $parz;

        return $final;
    }

    public function string_array($string_input)
    {
        $str_input = array();

        for ($i = 0; $i < strlen($string_input); ++$i) {
            $str_input[] = $string_input[$i];
        }

        return $str_input;
    }

    public function Permutation($string_input, $load = false, $appo = false)
    {
        $this->stringa = $this->string_array($string_input);

        if ($load == true && $appo != false) {
            $this->appostringa = explode('-', $appo);
        } else {
            $this->appostringa = $this->copy_array($this->stringa);
        }

        echo 'La stringa � lunga '.count($this->stringa).' caratteri.<br>';
        echo 'Quindi ci sono '.$this->factorial(count($this->stringa)).' permutazioni. <br>';
        echo 'Ce ne sono '.$this->count_permutation($this->stringa).' senza ripetizioni.<br><br>';

        return true;
    }
}
