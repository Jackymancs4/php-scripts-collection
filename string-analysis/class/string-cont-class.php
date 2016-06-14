<?php

class StringCont
{
    private $stringauno;
    private $stringadue;

    private $stringdrop;

    private function s_t_a($stringa_input)
    {
        for ($i = 0; $i < strlen($stringa_input); ++$i) {
            $str_input[] = $stringa_input[$i];
        }

        return $str_input;
    }

    private function d_f_s($stringauno, $stringadue)
    {
        foreach ($stringadue as $letteradue) {
            foreach ($stringauno as $chiaveuno => $letterauno) {
                if ($letterauno == $letteradue) {
                    unset($stringauno[$chiaveuno]);
                    break;
                }
            }
        }

        return $stringauno;
    }

    public function i_c()
    {
        if ((strlen(implode('', $this->stringauno))) == ((strlen(implode('', $this->stringadue))) + (strlen(implode('', $this->stringdrop))))) {
            return true;
        } else {
            return false;
        }
    }

    public function g_ds()
    {
        return implode('', $this->stringdrop);
    }

    public function StringCont($stringauno, $stringadue)
    {
        $this->stringauno = $this->s_t_a($stringauno);
        $this->stringadue = $this->s_t_a($stringadue);

        $this->stringdrop = $this->d_f_s($this->stringauno, $this->stringadue);
    }
}
