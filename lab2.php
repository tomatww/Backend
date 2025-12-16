<?php
	ini_set('display_errors', 1); 		
	ini_set('display_startup_errors', 1); 	
	error_reporting(E_ALL);
	
	// task 1
	$x = 5; 
	$y = null;
	if(abs($x) <= 4){
		$y = sin(exp($x)) - 2;
	} else if(abs($x) > 4 && abs($x) < 10){
		$y = ($x*$x - 1.2)/($x + 4);
	} else if($x >= 10){
		$y = $x;
	} else if($x <= -10){
		$y = 1.5;
	} else{
		$y = "Wrong value of x!";
	}
	echo "Result of task 1 is: ".$y."</br>";

	// task 2
	echo "Result of task 2 (a) is:</br>";
	$x = 1.2;
	while ($x <= 3.8) {
		$y = (5 * log10($x)) / ($x*$x - 1);
		echo "x = $x, y = $y</br>";
		$x += 0.4;
	}
	echo "</br>Result of task 2 (b) is:</br>";
	$x = 5.5;
	for ($i = 0; $i < 8; $i++) {
		$y = (5 * log10($x)) / ($x*$x - 1);
		echo "x = $x, y = $y</br>";
		$x += 1.5;
	}

	//task 3
	$k = 1;  
	$n = 10; 
	$s = 0;
	for ($i=$k; $i<=$n; $i++){
		$s += ($i*$i - $i + 3)/($i + 5);
	}
	echo "Result of sum s: ".$s."</br>";
	$p = 1;
	for ($i = 5; $i <= 11; $i++) {
    $p *= ((-1)**$i * $i * $i + 3) / (3 * $i + 2);
	}
	echo "Result of product p: ".$p."</br>";
	
	// task 14
	$B = [2.2 , 3.1, -3.6, 0.1, 2.1];
	$countLess = 0;
	for($i = 0; $i < count($B); $i++){
		if($B[$i] < 0.99){
			$countLess++;
		}
	}
	echo "Result of 4 task is: ".$countLess."</br>";
?>