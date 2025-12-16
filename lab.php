<?php
	//task 1
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	$x=2;
	$b=(exp(-pow($x,2.0))-exp(sqrt(abs($x-0.5)))+12.47 * $x) 
	/ (log10(abs($x + 1.0))-pow(log(abs(pow(2, $x) - 1.0)),3) + 1.0 / tan((pow($x, 2) - 1.0) / exp(1)));
	echo 'task 1 result: '.$b;
	echo '</br>';
	//task 2
	$x = -1;
	$y = 2;
	$result = ($y != $x) && (abs($x) * $y > 1);
	echo 'task 2 result: ';
	var_dump ($result);
	echo '</br>';
	//task 3
	$x = 0.03;
	$k = 4;
	$z = pow(log(abs(pow(2, $x) - 1)), 3) - 12.47;
	$beta = pow(exp(1), $k - 5.1) + log10(abs($k + $x));
	$b = pow($beta + abs($z), -exp(1)) + pow(abs($z), 1/3) + 0.1;
	echo 'task 3 result: ' . $b;
?>