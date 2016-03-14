<?php
    
    //Print all the possible permutation of an input string
    
    set_time_limit(0);
    ini_set("memory_limit","512M");
    
    include("class/permutation-class.php");
    include("class/spell-class.php");
    
    
    //?string=test
    
    $input = $_GET['string'];
    
    $perm = new Permutation($input);
    $permutations=$perm->start_perm(false, false);
    $spell = new Spell();
    
    //print_r($permutations);
    
    $handle = fopen("file/".$input.".xml", "w");
    
    fwrite($handle, '<list>');
    
    $i=0;
    $j=0;
    foreach($permutations as $name => $value) {
        if($spell->check($name)) {
            fwrite($handle, "<item>".$name."</item>");
            echo ($j+1)." - ".($i+1)." - ".$name."\n";
            $j++;
        }
        
        $i++;
    }
    
    fwrite($handle, "</list>");
    
    fclose($handle);
    
    ?>