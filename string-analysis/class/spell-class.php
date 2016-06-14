<?php

    class Spell
    {
        public $class = array();
        private $string = array(false, false);

        public function spell($string = false)
        {
            $this->class[0] = array('vocals', 'v', array('a', 'e', 'i', 'o', 'u'));
            $this->class[1] = array('consonat', 'c', array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'));
        }

        public function substitute($string, $class = false)
        {
            if ($this->string[0] == $string) {
                return implode('', $this->string[1]);
            }

            if ($class == false) {
                $class = $this->class;
            }

            $arraystring = str_split($string);
            $newstring = array();

            foreach ($arraystring as $letter) {
                $find = false;
                for ($i = 0; $i < count($class) && $find == false; ++$i) {
                    for ($j = 0; $j < count($class[$i][2]) && $find == false; ++$j) {
                        if ($letter == $class[$i][2][$j]) {
                            $find = true;
                            $newstring[] = $class[$i][1];
                        }
                    }
                }
            }

            $this->string[0] = $string;
            $this->string[1] = $newstring;

            return implode('', $newstring);
        }

        public function rule_four($string)
        {
            $sub = $this->substitute($string);
            $result = true;

            $re = '/(v{3,}|c{3,})/';

            preg_match_all($re, $sub, $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches[0] as $res) {
                $sub_str = substr($string, $res[1], strlen($res[0]));
                $cc = count_chars($sub_str, 3);

                if (strlen($res[0]) != strlen($cc)) {
                    $result = false;
                }
            }

            return $result;
        }

        public function rule_three($string)
        {
            $result = true;

            $re = '/(\\w)\\1+/';

            preg_match_all($re, $string, $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches[0] as $res) {
                if ($result == true && $this->substitute($res[0])[0] == 'v') {
                    $result = false;
                }
            }

            return $result;
        }

        public function rule_two($string)
        {
            $sub = $this->substitute($string);

            $re = '/(c{2,})/';

            preg_match_all($re, $sub, $matches, PREG_OFFSET_CAPTURE);

            if (isset($matches[0][0][1]) && $matches[0][0][1] == 0) {
                return false;
            } else {
                return true;
            }
        }

        public function rule_one($string)
        {
            $sub = $this->substitute($string);

            if ($sub[strlen($sub) - 1] == 'c') {
                return false;
            } else {
                return true;
            }
        }

        public function check($string)
        {
            if ($this->rule_one($string) && $this->rule_two($string) && $this->rule_three($string) && $this->rule_four($string)) {
                return true;
            } else {
                return false;
            }
        }
    }
