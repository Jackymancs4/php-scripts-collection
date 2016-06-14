<?php

class dfa
{
    public $state_map = array();
    public $states = array();
    public $transition_table = array();
    public $ffinal = array();

    public function get_state($s)
    {
        if (!in_array($s, $this->state_map)) {
            $this->state_map[] = $s;
            $this->states[] = $s;

            return count($this->states) - 1;
        } else {
            return array_search($s);
        }
    }

    public function fill_transition_table_entry($string, $state, $c_next)
    {
        $new_state[] = 0;
        $c = count($this->states[$state]);
        for ($i = 0; $i < $c; ++$i) {
            if ($string[$i] == $c_next) {
                $new_state[] = $i + 1;
            }
        }
        $this->transition_table[$state][$c_next] = $this->get_state($new_state);
        echo 'Adding edge '.$state.' -'.$c_next.'-> '.$this->transition_table[$state][$c_next].'<br>';
    }

    public function fill_transition_table($string)
    {
        $initial_pos[] = 0;
        $this->get_state($initial_pos);
        $c = count($this->states);
        for ($i = 0; $i < $c; ++$i) {
            for ($j = 0; $j < count($this->states[$i]);++$j) {
                if ($j == strlen($string)) {
                    $this->ffinal[$i] = true;
                } else {
                    $c_next = $string[$j];
                    if (!isset($this->transition_table[$i][$c_next])) {
                        $this->fill_transition_table_entry($string, $i, $c_next);
                    }
                }
            }
        }
    }

    public function dfa_string_search($first, $second)
    {
        $cur_state = 0;
        $cur_pos = 0;
        while ($cur_pos < strlen($second) && !isset($this->ffinal[$cur_state])) {
            $cur_state = $this->transition_table[$cur_state][$second[$cur_pos]];
            ++$cur_pos;
        }
        if ($this->ffinal[$cur_state] == true) {
            return $cur_pos - strlen($first);
        } else {
            return -1;
        }
    }
}

$first = 'MOMMY';
$second = 'MOMMMYMOMMYMM';

$dfa = new dfa();

$dfa->fill_transition_table($first);
//$result=$dfa->dfa_string_search($first, $second);

$result = 0;
if ($result == -1) {
    echo 'No match found.<br>';
} else {
    echo 'Match at position '.$result.'<br>';
}
