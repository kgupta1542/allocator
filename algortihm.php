<?php
	include_once 'GetCombinations.php';
	
	//Define Arrays
	$origMaterial = array(120,60);//Make dynamic
	rsort($origMaterial);
	
	$origTask = array(80,60,45,30);//Make dynamic
	rsort($origTask);
	$allocMaterial = array();
	
	$remainderMaterial = $origMaterial;
	$remainderTask = $origTask;
	$comboArray = array();
	$comboIndex = array();
	
	function createCombinations(){
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
	}
	
	//Check for Matches
	for($i=0; $i<count($origMaterial); $i++){

	    for($j=0; $j<count($comboArray); $j++){
	    	createCombinations();
	        if($remainderMaterial[$i] == $comboArray[$j]){//Switch second one with combinations array
	            $allocMaterial[$i] = array($j);
	            $remainderMaterial[$i] = $remainderMaterial[$i] - $comboArray[$j];
	            $remainderTask[$j] = null;//Make function to remove all task indexes from $comboIndex
	            $comboArray[$j] = null; //Switch to index-mapping array for combinations
	            break;
	        }
	    }
	}
	
	//Check for Best Way to Allocate
	$diff = $remainderMaterial[$k];
	$bestCase;
	for($k=0; $k<count($origMaterial); $k++){
		createCombinations();
		for($l=0; $l<count($comboArray); $l++){
			$diff1 = $remainderMaterial[$k] - $comboArray[$l];
			if($diff1 != null && $diff1 < $diff && diff > 0){
				$bestCase = $l;
				$diff = $diff1;
			}
		}
		
		$combination = $comboArray[$bestCase];
		$allocIndex = $comboIndex[$bestCase];
		$remainderMaterial[$k] = $remainderMaterial[$k] - $combination;
		if($allocMaterial[$k] == null || $allocMaterial[$k] == ""){	//Adding pairings
			$allocMaterial[$k] = array();
			$allocMaterial[$k] = $allocIndex;
		}
		else{
			$allocMaterial[$k] = array_merge($allocMaterial[$k],$allocIndex);
		}
		for($m=0; $m<count($allocIndex);$m++) {
			$remainderTask[$m] = null;
		}
	}
	
	var_dump($origMaterial);
	echo("<br/>");
	var_dump($origTask);
?>