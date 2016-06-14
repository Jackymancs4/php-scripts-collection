<?php

$class = array();

$class[0] = array('vocals', 'v', array('a', 'e', 'i', 'o', 'u'));
$class[1] = array('consonat', 'c', array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'));

$string = 'gicorosso';

function substitute($string, $class)
{
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

    return implode('', $newstring);
}

$aaaa = substitute($string, $class);
echo $aaaa.'<br>';

$subject = $aaaa;
$pattern = '/c{2}/';

$bb = preg_match($pattern, $subject);

print_r($bb);
