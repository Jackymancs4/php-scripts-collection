<?php

class ColorInterface extends Color {

  public function print_table ($matrix, $heightcell=1, $widthcell=1) {
  
    echo "<table style=\"border-collapse:collapse\">";
    for($i=0; $i<count($matrix); $i++) {
     echo "<tr>";
      for($j=0; $j<count($matrix[0]); $j++) {
          echo "<td style=\"border:0; margin:0; padding:0;\"><div style=\"height:".$heightcell."px; width:".$widthcell."px; background-color:rgb(".$matrix[$i][$j].");\"></div></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  
  }
  
  public function print_image($matrix) {

    $my_img = imagecreatetruecolor(count($matrix[0]),count($matrix));
    
    $color=array();
    
    for($i=0; $i<count($matrix); $i++) {
      for($j=0; $j<count($matrix[0]); $j++) {
        
        $rcolor=explode(",",$matrix[$i][$j]);  
          
        $color[] = imagecolorallocate($my_img, $rcolor[0], $rcolor[1], $rcolor[2]);
        imagesetpixel($my_img, $j,$i, $color[count($color)-1]);
      } 
    }
    
    header('Content-Type: image/png');
    imagepng($my_img);
    imagedestroy($my_img);
  }

}
?>