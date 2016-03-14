<?php

class Derivate {

  private $rules=array(array("x\^(.*)","n*x^(n-1)","n"));
  
  public function ruler ($function, $variable) {
    $out = preg_match_all("/".$this->rules[0][0]."/", $function, $matchs);
    $result = str_replace($this->rules[0][2],$matchs[1][0],$this->rules[0][1]);
    return $result;
    //print_r($matchs);
  }

  public function deriv ($function, $variable) {
  
  
      
    return 0;
  
  }

  public function parse ($function, $variable) {  
  
    $out = preg_match_all("/\((.*)\)/", $function, $matchs);
    
    foreach ($matchs[1] as $exp) {
       if (!strpos($exp,$variable)) {       
         eval('$res='.$exp.";");
         $function = str_replace($exp,$res,$function);
       }
    }
    return $function;
  }
       
}

?>     