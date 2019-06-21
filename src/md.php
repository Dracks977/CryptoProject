<?php

function MeDeCrypt(){
	$infos = array();
	array_push($infos, readline("Entrer Votre clef secret séparer par des espace (suite super croisante) : "));
	array_push($infos, readline("Entrer le nombre e choisi durant la génération de la clef publique : "));
	array_push($infos, readline("Entrer le nombre m choisi durant la génération de la clef publique : "));
	array_push($infos, readline("Entrer la permutation séparer par des espaces : "));
	array_push($infos, readline("Entrer le nombre n (découpage des packet) : "));
	array_push($infos, readline("Entrer le message crypter : "));
	$infos[0] = explode(" ", $infos[0]);
	$infos[3] = explode(" ", $infos[3]);
	$infos[5] = explode(" ", $infos[5]);
	MDC($infos);
}

function MDC($infos){
	$i = 0;
	$d = inv_modulo(intval($infos[1]), intval($infos[2]));
	foreach ($infos[5] as &$l) {
		$l = my_modulo(intval($l * $d),intval($infos[2]));
	}
	$SS = array();
	foreach ($infos[3] as &$p) {
		$SS[$p - 1] = $infos[0][$i];
		$i++;
	}
	$INVS = array_reverse($infos[0]);
	$u = 0;
	foreach ($infos[5] as &$ms) {
		for ($somme = array(),$som = 0,$o = 0; $o != count($INVS) && $som <= intval($ms);$o++){
			if ($INVS[$o] <= ($ms - $som)){
				$som += intval($INVS[$o]);
				array_push($somme,intval($INVS[$o]));
			}
		}
		$infos[6][$u] = $somme;
		$u++;
	}
	$bitmsg = "";
	$string = "";
	while( strlen($string) != intval($infos[4]) )
		$string .= "0";
	for($j = 0 ; $j != count($infos[5]); $j++) {
		$tmp = $string;
		foreach ($infos[6][$j] as &$bit) {
			$index = array_search(intval($bit), $SS);
			$tmp[abs(intval($infos[4]) - $index - 1)] = "1";
		}
		$bitmsg .= $tmp;
	}
	$bitar = str_split($bitmsg, 8);
	echo "Message décripter : ";
	foreach ($bitar as &$lett) {
		if (strlen($lett) == 8)
			echo chr(bindec($lett));
	}
	echo "\n";
}