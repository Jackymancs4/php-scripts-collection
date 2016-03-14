<?php

class Astar {

  public function heuristic_cost_estimate ($start, $goal) {
    return 0;
  }

  public function min_val ($vet=0) {
    $min=0;
    $minindex=0;
    for($i=0; $i<count($vet); $i++) {    
      if ($min>$vet[$i]) {
        $min=$vet[$i];
        $minindex=$i;
      }
    }
    
    echo $minindex;
    return $minindex;
  }

  public function get_ind ($val, $vet) {
    $index=0;
    for($i=0; $i<count($vet); $i++) {    
      if ($val==$vet[$i]) {
        $index=$i;
      }
    }
    
    return $index;
  }

  public function get_neighbor ($cell, $mat) {
    $neighbor=array();
    if ($mat[$cell[0]+1][$cell[1]]==($cell[2]+1)) {
      $neighbor[]=array($cell[0]+1, $cell[1], $mat[$cell[0]+1][$cell[1]]);
    }
    if ($mat[$cell[0]][$cell[1]+1]==($cell[2]+1)) {
      $neighbor[]=array($cell[0], $cell[1]+1, $mat[$cell[0]][$cell[1]+1]);
    }
    if ($mat[$cell[0]+1][$cell[1]+1]==($cell[2]+1) || $mat[$cell[0]+1][$cell[1]+1]==($cell[2])) {
      $neighbor[]=array($cell[0]+1, $cell[1]+1, $mat[$cell[0]+1][$cell[1]+1]);
    }      
    print_r($cell);
    echo "<br>";
    print_r($neighbor);
    echo "<br>";
    return $neighbor;
    
  }

  public function reconstruct_path($came_from, $current) {
    $total_path=array($current);
    
    print_r($came_from);    
  }

  public function Astar ($start, $goal, $mat) {
  
    $closedset=array();
    $openset=array($start);
    $topenset=$openset;
    $came_from=array();
    
    $g_score=array(0);
    $f_score=array(($g_score[0]+$this->heuristic_cost_estimate ($start, $goal)));
  
    $t_score=$f_score;
   
    while (count($topenset)!=0) {
      $min=$this->min_val($t_score);
            
      $current=$openset[$min];
      
      if ($current==$goal) {
          return $came_from;
      }
      
      unset($topenset[$min]);
      $openset[$min]=false;
      unset($t_score[$min]);
      
      $closedset[]=$current;
      
      
      $neighbor=$this->get_neighbor($current, $mat);
      
      for ($i=0; $i<count($neighbor); $i++) {
        if (!in_array($neighbor[$i],$closedset)) {
          $tentative_g_score=$g_score[$min]+$neighbor[$i][2];
          
           //|| $tentative_g_score<$g_score[$this->get_ind($neighbor[$i], $openset)]
                    
          if (!in_array($neighbor[$i],$openset)) {
             $openset[]=$neighbor[$i];
             $topenset[]=$neighbor[$i];
             $came_from[]=$neighbor[$i];
             $g_score[]=$tentative_g_score;
             $f_score[]=$g_score[count($g_score)-1]+$this->heuristic_cost_estimate ($neighbor[$i], $goal);
             $t_score[]=$g_score[count($g_score)-1]+$this->heuristic_cost_estimate ($neighbor[$i], $goal);
          
          } elseif ($tentative_g_score<$g_score[$this->get_ind($neighbor[$i], $openset)]) {
             
             $indexneightbor=$this->get_ind($neighbor[$i], $openset);
             $came_from[$indexneightbor]=$neighbor[$i];
             $g_score[$indexneightbor]=$tentative_g_score;
             $f_score[$indexneightbor]=$g_score[count($g_score)-1]+$this->heuristic_cost_estimate ($neighbor[$i], $goal);
             $t_score[$indexneightbor]=$g_score[count($g_score)-1]+$this->heuristic_cost_estimate ($neighbor[$i], $goal);

          }
                    
        }
      }
      
    }
  
    return $came_from;
  
  }

}

class LenvenDist {

  public $edit=array();

  public function mat_print($mat){
    echo "<table>";
    foreach($mat as $ival) {
      echo "<tr>";
      foreach($ival as $jval) {
        echo "<td>".$jval."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  public function vet_print($vet) {
    echo "<table>";
    foreach ($vet as $val) {
      echo "<tr><td>".$val."</tr></td>";
    }
    echo "</table>";
  }

  public function minimun ($a, $b, $c) {
  	$min=$a;
	$op="Inserimento";
	
  	if($b<$min) {
  		$min=$b;
  		$op="Cancellazione";
	}
  	if($c<$min){
  		$min=$c;
		$op="Sostituzione";
  	}
	
	$this->edit[]=$op;
  	return $min;
  }
  
  public function levenshtein_s ($first, $second) {
  	
  	$d=array();
  	
  	for($i=0; $i<=strlen($first); $i++) {
  		$d[$i][0]=$i;
  	}
  	for($i=0; $i<=strlen($second); $i++) {
  		$d[0][$i]=$i;
  	}
  
  	for($i=1; $i<=strlen($first); $i++) {
  		for($j=1; $j<=strlen($second); $j++) {
  			if($first[$i-1]==$second[$j-1]) {
  				$cost=0;
  			} else {
  				$cost=1;
  			}
  			$d[$i][$j]=$this->minimun($d[$i-1][$j]+1, $d[$i][$j-1]+1, $d[$i-1][$j-1]+$cost);
  		}
  	}
  	
    //$this->mat_print($d); 
    
    echo "<br>";
    
    $astar=new Astar(array(0,0,0),array(strlen($first),strlen($second),$d[strlen($first)][strlen($second)]),$d);
    
    print_r($astar);
       
  	return $d[strlen($first)][strlen($second)];
  
  }

}

?>