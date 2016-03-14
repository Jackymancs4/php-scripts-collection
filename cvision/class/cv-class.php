<?php

class CV {

  private $type=false;

  public $originalimage=false;
  public $newimage=false;
  
  public function multi_sampler ($threshold, $conf="d") {
  
    $class = array(array(0,0,0));

    $imx = imagesx($this->originalimage);
    $imy = imagesy($this->originalimage);
    
    $img = imagecreatetruecolor ($imx, $imy);    
    
    for($i=1; $i<$imx; $i++) {
      for($j=1; $j<$imy; $j++) {
    
        $color_index = imagecolorat($this->originalimage, $i, $j);
        $color_tran = imagecolorsforindex($this->originalimage, $color_index);
        
        $cc=array($color_tran['red'],$color_tran['green'],$color_tran['blue']);
    
        $stop=false;
        $h=0;
        for ($h=0; $h<count($class) && $stop==false; $h++) {
          if (($conf=="d" && $this->confront_d($class[$h],$cc,$threshold)) || ($conf=="t" && $this->confront_t($class[$h],$cc,$threshold))) {
            $stop=$h;
          }
        }
         
        if ($stop==false) {
          $class[]=$cc;
        } else {}
         
        $stop=$h+1;
          
        $pixel=imagecolorallocate($img, $class[$h-1][0], $class[$h-1][1], $class[$h-1][2]);    
        imagesetpixel($img, $i, $j, $pixel); 
          
      }
      
    }
    
    $this->newimage=$img;
    return $img;
  }
  
  public function confront_d($colorone, $colortwo, $threshold) {
    if ($this->distance($colorone, $colortwo)<$threshold) {
      return true;
    } else {
      return false;
    }
  }
  
  public function distance ($colorone, $colortwo) {
    
    return (int)round(sqrt(2*($colorone[0]-$colortwo[0])*($colorone[0]-$colortwo[0])+4*($colorone[1]-$colortwo[1])*($colorone[1]-$colortwo[1])+3*($colorone[2]-$colortwo[2])*($colorone[2]-$colortwo[2])));
    
  }  
  
  public function confront_t ($colorone, $colortwo, $threshold) {

   if (abs(($colorone[0]-$colortwo[0]))<$threshold &&
      abs(($colorone[1]-$colortwo[1]))<$threshold &&
      abs(($colorone[2]-$colortwo[2]))<$threshold) {
        return true;
     } else {
        return false;
     }
  }
  
  public function lightness ($x,$y) {
    
    $color_index = imagecolorat($this->originalimage, $x, $y);
    $color_tran = imagecolorsforindex($this->originalimage, $color_index);
  
    $light=($color_tran['red']+$color_tran['green']+$color_tran['blue'])/3;
    
    return (int)round($light);
  }
  
  public function lightmat () {
    
    $lightmat=array();
  
    for($i=0; $i<imagesx($this->originalimage); $i++) {
      for($j=0; $j<imagesy($this->originalimage); $j++) {
         $lightmat[$i][$j]=$this->lightness($i,$j);
      }
    }
    return $lightmat;
  }
  
  public function load ($address, $type="auto") {
           
    if(file_exists($address)) {
        
      if($type=="auto") {
        $ext=explode(".", $address);
        $type=$ext[count($ext)-1];
      }        
        
      switch ($type) { 
        case 'png':
          $this->originalimage=imagecreatefrompng($address);
        break;
        
        case 'jpg':
          $this->originalimage=imagecreatefromjpeg($address);
        break;
      }
      
      $this->type=$type;
      return true;
    } else {
      return false;
    }  
  }
  
  public function grey_image () {
    
    $imx = imagesx($this->originalimage);
    $imy = imagesy($this->originalimage);
    
    $img = imagecreatetruecolor ($imx, $imy);
    
    for($i=1; $i<$imx-1; $i++) {
      for($j=1; $j<$imy-1; $j++) {
    
        $light=$this->lightness($i,$j);        
      
          $pixel=imagecolorallocate($img, $light, $light, $light);    
          imagesetpixel($img, $i, $j, $pixel); 
          
      }
      
    }
    
    $this->newimage=$img;
    return $img;

  }
  
  public function simple_edge ($threshold, $background=false) {
    
    $imx = imagesx($this->originalimage);
    $imy = imagesy($this->originalimage);
    
    $img = imagecreatetruecolor ($imx, $imy);
    
    $light=$this->lightmat();
    
    for($i=1; $i<$imx-1; $i++) {
      for($j=1; $j<$imy-1; $j++) {
    
        /*
        $lightarray[]=lightness($i-1,$j-1,$image);
        $lightarray[]=lightness($i,$j-1,$image);
        $lightarray[]=lightness($i,$j-1,$image);
        $lightarray[]=lightness($i-1,$j,$image);
        $lightarray[]=lightness($i+1,$j,$image);
        $lightarray[]=lightness($i-1,$j+1,$image);
        $lightarray[]=lightness($i,$j+1,$image);
        $lightarray[]=lightness($i+1,$j+1,$image);    
        */
    
        $lightarray[0]=$light[$i-1][$j-1];
        $lightarray[1]=$light[$i][$j-1];
        $lightarray[2]=$light[$i][$j-1];
        $lightarray[3]=$light[$i-1][$j];
        $lightarray[4]=$light[$i+1][$j];
        $lightarray[5]=$light[$i-1][$j+1];
        $lightarray[6]=$light[$i][$j+1];
        $lightarray[7]=$light[$i+1][$j+1];    
        
        
        if(max($lightarray)-min($lightarray)>$threshold){
          $pixel=imagecolorallocate($img, 0, 0, 0);    
          imagesetpixel($img, $i, $j, $pixel); 
        } else {
          if ($background==true) {
            $color_index = imagecolorat($this->originalimage, $i, $j);
            $color_tran = imagecolorsforindex($this->originalimage, $color_index);

          } else {
            $color_tran=array("red"=>255,"green"=>255,"blue"=>255);
          }
          $pixel=imagecolorallocate($img, $color_tran["red"], $color_tran["green"], $color_tran["blue"]);    
          imagesetpixel($img, $i, $j, $pixel); 
        }   
          
      }
      
    }
    
    $this->newimage=$img;
    return $img;
  }
  
  public function return_image ($type="auto") {
  
    if($type=="auto") {
      $type=$this->type;
    }
    
      switch ($type) { 
        case 'png':
          header('Content-Type: image/png') ;
          if($this->newimage==false) {
            imagepng($this->originalimage);
          } elseif ($this->newimage!=false && $this->originalimage!=false) {
            imagepng($this->newimage);
          }                       
        break;
        case 'jpg':
          header('Content-Type: image/jpeg') ;
          if($this->newimage==false) {
            imagejpeg($this->originalimage);
          } elseif ($this->newimage!=false && $this->originalimage!=false) {
            imagejpeg($this->newimage);
          }  
        break;
      }
      
      if($this->originalimage!=false) {
        imagedestroy($this->originalimage);
      }
      if($this->newimage!=false) {
        imagedestroy($this->newimage);
      }
                  
      return true;
    
  }

}

?>