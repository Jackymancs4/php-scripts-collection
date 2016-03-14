<?php

ini_set('memory_limit', '512M');
set_time_limit(0);

$lightness=0;

for ($f=0;$f<256;$f++) {
  $count=0;
  for($i=0;$i<256;$i++) {
    for($j=0;$j<256;$j++) {
      for($h=0;$h<256;$h++)  {
        if(($i+$j+$h)/3==$f) {
          //echo $i." ".$j." ".$h."<br>";
          $count++;
        }
      }
    }
  }
  echo $f." => ".$count."<br>";
  
}

?>