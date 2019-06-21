<?php

function GKey(){
	$true = true;
	while ($true){
		$suites = readline("Entrer une suite super croissante séparé par des espaces (le jème terme doit être > que la somme des j-1 termes qui le précèdent dans la suite) : ");
		$suites = explode(" ", $suites);
		$somme = 0;
		$true = false;
		foreach ($suites as &$value) {
			if ($somme > $value){
				$true = true;
				echo "\033[1m\033[31m{$value} est inférieur a la somme des nombres la précedant\033[0m\n";
			}
			$somme += intval($value);
		}
	}
	$true = true;
	while ($true){
		$m = readline("Entrer m supérieur à {$somme} : ");
		if ($m > $somme)
			$true = false;
		else
			echo "\033[1m\033[31mChiffre incorect m doit étre superieur a {$somme}\033[0m \n";
	}
	$true = true;
	while ($true){
		$e = readline("Entrer e inférieur à {$m} (!=0) de telle sort qu'il soit premier avec {$m}: ");
		$gcd = gcd($m, $e);
		if ($e < $m && $e != 1 && $gcd == 1)
			$true = false;
		else 
			echo "\033[1m\033[31mChiffre incorect respecter le format (e < m && e != 1 && pgcd(e, m) == 1)\033[0m \n";
	}
	GenKey($suites, $m, $e);
}

function GenKey($suites, $m, $e){
	echo "\033[31mClef Intermediaire (keep secret) :";
	echo "\033[31me (keep secret) = {$e} ";
	echo "\033[31mm (keep secret) = {$m} ";
	$hhh = "";
	foreach ($suites as &$value){
		$value = my_modulo(($value * $e), $m);
		echo " {$value}";
	}
	$S1 = $suites;
	sort($suites);
	echo "\n\033[32mClef Publique (distribut) :";
	foreach ($suites as &$value){
		echo " {$value}";
	}
	foreach ($S1 as &$key) {
		$hhh .= (array_search($key, $suites) + 1) . " ";
	}
	echo "\033[31m\nPermutation (keep secret): {$hhh}\033[0m\n";
	echo "Pensez a conserver secret la suite supercroisante, les nombres e et m et la permutation\n";
}