<?php

class Expression
{
    private $optable = array(array('^', 4, 'R'),
                         array('*', 3, 'L'),
                         array('/', 3, 'L'),
                         array('+', 2, 'L'),
                         array('-', 2, 'L'), );

    private $ftable = array(array('sin', 1),
                        array('cos', 1),
                        array('tan', 1),
                        array('ln', 1),
                        array('log', 2), );

    public function conf_op($firstop, $secondop)
    {
        foreach ($this->optable as $op) {
            if ($firstop == $op[0]) {
                $firstop = $op;
            }
            if ($secondop == $op[0]) {
                $secondop = $op;
            }
        }

        if (($firstop[2] == 'L' && $firstop[1] <= $secondop[1]) || ($firstop[2] == 'R' && $firstop[1] < $secondop[1])) {
            return true;
        } else {
            return false;
        }
    }

    public function checktoken($token)
    {
        $type = 'val';

        $digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

        foreach ($this->optable as $op) {
            if ($token == $op[0]) {
                $type = 'op';
            }
        }
        if ($token == '(') {
            $type = 'l_par';
        }
        if ($token == ')') {
            $type = 'r_par';
        }
        if (in_array($token, $digits)) {
            $type = 'digit';
        }

        return $type;
    }

    public function shunting_yard_switch($infix = false)
    {
        $lenght = count($infix);
        $index = 0;

        $stack = array();
        $output = array();

        while ($lenght > 0) {
            $token = $infix[$index];
            $tokentype = $this->checktoken($token);

            switch ($tokentype) {
        case 'digit':
        case 'val':
          if (isset($infix[$index + 1]) && $this->checktoken($infix[$index + 1]) == 'digit') {
              $token = (int) ($token.$infix[$index + 1]);

              ++$index;
              --$lenght;
          }
          $output[] = $token;

        break;
        case 'op':
          $stop = false;
          while ($this->checktoken(end($stack)) == 'op' && $stop == false) {
              if ($this->conf_op($token, end($stack)) == true) {
                  $output[] = array_pop($stack);
              } else {
                  $stop = true;
              }
          }
          $stack[] = $token;
        break;
        case 'l_par':
          $stack[] = $token;
        break;
        case 'r_par':
          while (end($stack) != '(') {
              $output[] = array_pop($stack);
          }
          array_pop($stack);
        break;
      }

            ++$index;
            --$lenght;
        }

        while (count($stack) != 0) {
            $output[] = array_pop($stack);
        }

        return $output;
    }

    public function to_array($string)
    {
        $array = array();
        for ($i = 0; $i < strlen($string); ++$i) {
            $array[] = $string[$i];
        }

        return $array;
    }

    public function re_array($string)
    {
        $restring = array();
        for ($i = count($string) - 1; $i >= 0; --$i) {
            $restring[] = $string[$i];
        }

        return $restring;
    }

    public function to_postfix($infix = false)
    {
        $infix = $this->to_array($infix);
        $output = implode('', $this->shunting_yard_switch($infix));

        return $output;
    }

    public function to_prefix($infix = false)
    {
        $infix = $this->to_array($infix);
        $infix = $this->re_array($infix);

        for ($i = 0; $i < count($infix); ++$i) {
            if ($infix[$i] == '(') {
                $infix[$i] = ')';
            } elseif ($infix[$i] == ')') {
                $infix[$i] = '(';
            }
        }

        $postfix = $this->shunting_yard_switch($infix);
        $postfix = $this->re_array($postfix);

        $output = implode('', $postfix);

        return $output;
    }

    public function to_infix($string, $type = true)
    {
        $string = $this->to_array($string);
        $lenght = count($string);
        $stack = array();
        $index = 0;

        while ($lenght > 0) {
            $token = $string[$index];
            $tokentype = $this->checktoken($token);

            switch ($tokentype) {
              case 'digit':
              case 'val':

                if (isset($string[$index + 1]) && $this->checktoken($string[$index + 1]) == 'digit') {
                    $token = ($token.$string[$index + 1]);

                    ++$index;
                    --$lenght;
                }

                $stack[] = $token;

              break;
              case 'op':
                if (count($stack) < 2) {
                    echo 'error';
                    exit();
                } else {
                    $op1 = array_pop($stack);
                    $op2 = array_pop($stack);

                    $output = '('.$op2.$token.$op1.')';
                    $stack[] = $output;
                }
              break;
            }

            ++$index;
            --$lenght;
            //echo $lenght;
        }

        print_r($this->ftable);

        if (count($stack) == 1) {
            return array_pop($stack);
        }
    }
}
