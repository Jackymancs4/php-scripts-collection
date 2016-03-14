<?php

class CommonPattern {

	function CommonPattern ($first, $second, $print=false) {
		$first=$this->s_to_a($first);
		$second=$this->s_to_a($second);

		$rend=$this->check_pattern($first, $second);
		print_r($rend);

		$rend=$this->rev_check($first, $second);
		print_r($rend);
		
		$rend=$this->back_check($first, $second);
		print_r($rend);

		$rend=$this->back_rev_check($first, $second);
		print_r($rend);

		if($print==true) {
			$this->print_rend($first, $second, $rend);
		}
		return $rend;
	}
	
public function s_to_a ($string) {
	$array=array();
	$c=strlen($string);
	
	for($i=0; $i<$c; $i++) {
		$array[$i]=$string[$i];
	}
	return $array;
}

public function reverse_array($array) {
	$c=count($array);
	$newarray=array();
	for($i=1; $i<=$c; $i++) {
		$newarray[]=$array[$c-$i];
	}
	return $newarray;
}

public function rev_check ($first, $second) {
	return $this->check_pattern($second, $first);
}

public function back_check ($first, $second) {
	$first=$this->reverse_array($first);
	$second=$this->reverse_array($second);

	return $this->check_pattern($first, $second);
}

public function back_rev_check ($first, $second) {
	$first=$this->reverse_array($first);
	$second=$this->reverse_array($second);

	return $this->rev_check($first, $second);
}

public function check_pattern ($first, $second) {
	$table=$this->table($first);
	$newtable=$this->sub_table($second,$table);
	
	$res=$this->eval_table($newtable);
	$rend=$this->render_table($res,$table);	
	
	return $rend;
}
	
public function print_rend($first, $second, $rend) {
	echo "Le stringhe: <br>".$first."<br>".$second."<br>hanno in cumune:<br><br>";
	foreach($rend as $value) {
		foreach ($value as $string){
			echo $string;
		}
	echo "<br>";
	}
}

public function table ($string) {
	$table=array();
	$c=count($string);
	for($i=0;$i<$c;$i++){
		$table[$string[$i]][]=($i+1);
	}
	
	return $table;
}

public function sub_table ($string, $table) {
	$newtable=array();
	$c=count($string);
	for($i=0; $i<$c; $i++) {
		if(isset($table[$string[$i]])) {
			$newtable[]=$table[$string[$i]];
		}
	}
	return $newtable;
}

public function eval_table($table) {
	$c=count($table);
	$count=0;
	$res=array();
	$old=0;
	for($i=0; $i<$c; $i++) {
		$stop=false;
		$d=count($table[$i]);
		for($j=0; $j<$d && $stop==false; $j++){
			if($table[$i][$j]>$old) {
				$old=$table[$i][$j];
				$res[$count][]=$table[$i][$j];
				$stop=true;
			}
		}
		if($stop==false) {
			$count++;
			$old=0;
			$res[$count][]=$table[$i][0];
		}
	}
	return $res;
	}

public function render_table ($res, $table) {
	for($i=0; $i<count($res); $i++){
		for($j=0; $j<count($res[$i]); $j++){
			foreach($table as $key => $value) {
				if (in_array($res[$i][$j],$value)) {
					$res[$i][$j]=$key;
				}
			}
		}
	}
	return $res;
}
}


$comp=new CommonPattern("cuore", "corason");

?>
