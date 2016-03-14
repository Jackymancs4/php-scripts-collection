<?php

class ColorExperiment extends ColorInterface {

  
  public function light_colortable($print="i") {
      
    $x=255;
    $y=360;
    
    $mcolor=array();
    
    for($i=0; $i<$y; $i++) {
      for($j=0; $j<=$x; $j++) {
        
        $mcolor[$i][$j]=$this->rgb($i,$j);  

      } 
    }

    switch($print) {    
      case "i":
        $this->print_image($mcolor);
      break;
      case "t":
        $this->print_table($mcolor);
      break;
      case "n":
        return $mcolor;
      break;
    }
  }
  
  public function dark_colortable($print="i") {
      
    $x=255;
    $y=360;
    
    $mcolor=array();
    
    for($i=0; $i<$y; $i++) {
      for($j=$x; $j>=0; $j--) {
        
        $mcolor[$i][255-$j]=$this->rgb($i,0,$j);  

      } 
    }

    switch($print) {    
      case "i":
        $this->print_image($mcolor);
      break;
      case "t":
        $this->print_table($mcolor);
      break;
      case "n":
        return $mcolor;
      break;
    }
  }
  
  public function gradient ($height, $fistcolor="auto", $secondcolor="auto") {
  
    if($fistcolor=="auto") {
      $fistcolor=$this->rand_color();
    }
    if($secondcolor=="auto") {
      $secondcolor=$this->rand_color();
    }
  
    $max=max(array(abs($fistcolor[0]-$secondcolor[0]),abs($fistcolor[1]-$secondcolor[1]),abs($fistcolor[2]-$secondcolor[2])));
  
    $R=$this->single_conf_color($fistcolor[0],$secondcolor[0],abs($fistcolor[0]-$secondcolor[0])/$max, $max);
    $G=$this->single_conf_color($fistcolor[1],$secondcolor[1],abs($fistcolor[1]-$secondcolor[1])/$max, $max);  
    $B=$this->single_conf_color($fistcolor[2],$secondcolor[2],abs($fistcolor[2]-$secondcolor[2])/$max, $max);
    
    for($i=0; $i<count($R); $i++) {
      $matrix[][0]=$R[$i].",".$G[$i].",".$B[$i];
    }
    
    return $matrix;    
    
  }  

}
?>