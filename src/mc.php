<?php

function MeCrypt(){
	$public = readline("Entrer la clef public séparé par des espaces (ex: 512 888 965 1258) : ");
	$public = explode(" ", $public);
	$message = readline("Entrer le message a crypter : ");
	$message = str_split($message);
	$ll = "";
	foreach ($message as &$l) {
		$ll .= $l = str_pad(decbin(ord($l)), 8, "0", STR_PAD_LEFT);
	}
	$ll = str_split($ll);
	$cpublic = count($public);
	$true = true;
	while ($true){
		$package = readline("Entrer un nombre comprit entre 2 et {$cpublic} inclus : ");
		if ($package >= 2 && $package <= $cpublic)
			$true = false;
	}
	MC($ll,$package, $public);
}

function MC($ll, $package, $public){
	$arr = array(); //message en bin et avec des packages
	for($j = 0, $i = 1, $string = ""; $j != (count($ll)); $j++) {
		$string .= $ll[$j];
		if ($i == $package){
			array_push($arr, $string);
			$i = 0;
			$string = "";
		} else if ($j == count($ll) - 1){
			while(strlen($string) != $package)
				$string .= "0";
			array_push($arr, $string);
		}
		$i++;
	}
	$msgcrypt = "";
	foreach ($arr as &$msg) {
		for($add = 0, $p = 0;$p != strlen($msg);$p++){
			if($msg[$p] == "1")
				$add += $public[abs($package - $p -1)];
		}
		$msgcrypt .= " " . $add;
	}
	echo "votre message crypter est : {$msgcrypt}\nLe nombre (n) pour les package est de {$package}\n"; 
}
