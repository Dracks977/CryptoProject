<?php

function my_modulo($int, $n) {
	$quotient = ($int / $n);
	if ($n > 0)
		$quotient_entier = floor($quotient);
	else
		$quotient_entier = ceil($quotient);
	$reste = ($int - $n * $quotient_entier);
	return $reste;
}

function gcd($a,$b)
{
	for($c = my_modulo($a, $b) ; $c != 0; $c= my_modulo($a, $b) ) {
		$a = $b;
		$b = $c;
	}
	return $b;
}

function inv_modulo($int, $n) {
	if ($n <= 0 || !is_int($int) || !is_int($n)
		|| gcd($int, $n) != 1 ) {
		echo "va t'acheter des doigts !\n";
	return (0);
} else {
	for ($i=0; my_modulo($i*$int,$n) != 1 ; $i++);
		return $i;
}
}