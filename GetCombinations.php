<?php
	function getCombinations($base,$n){
	    $baselen = count($base);
	    if($baselen == 0){     
	        return; 
	    }
	    if($n == 1){         
	        $return = array();
	        foreach($base as $b){
	        $return[] = array($b);
	     }
	        return $return;
	     }
	    else{         
	        //get one level lower combinations         
	        $oneLevelLower = getCombinations($base,$n-1);          
	        //for every one level lower combinations add one element to them that the last element of a combination is preceeded by the element which follows it in base array if there is none, does not add         
	        $newCombs = array();
	        foreach($oneLevelLower as $oll){
	            $lastEl = $oll[$n-2];
	            $found = false;
	            foreach($base as  $key => $b){
	                if($b == $lastEl){
	                    $found = true;
	                    continue;
	                    //last element found
	                }
	                if($found == true){
	                    //add sto combinations with last element
	                    if($key < $baselen){
	                        $tmp = $oll;
	                        $newCombination = array_slice($tmp,0);
	                        $newCombination[]=$b;
	                        $newCombs[] = array_slice($newCombination,0);
	                    }
	                }
	            }
	        }
	    }
	    return $newCombs;
	}
	
	$base = array(4,3,2,1);
	$comboArray = array();
	$comboIndex = array();
	$indexArr = array();
	for($i = 1; $i<=count($remainderTask);$i++){     
	    $comb = getCombinations($remainderTask,$i);      
	    foreach($comb as $c){
	        $sum=0;
	        for($j=0;$j<count($c);$j++){
	            $indexVal = array_search($c[$j],$remainderTask);
	            array_push($indexArr,$indexVal);
	            $sum += $c[$j];
	        }
	        array_push($comboArray,$sum);
	        array_push($comboIndex,$indexArr);
	        unset($indexArr);
	        $indexArr = array();
	    }  
	}
?>
