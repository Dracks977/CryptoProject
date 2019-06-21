<?php

include 'src/utils.php';
include 'src/gkey.php';
include 'src/mc.php';
include 'src/md.php';

main();

function main(){
	echo "1 : Génération d'une clé publique \n2 : Chiffrement d'un message \n3 : Déchiffrement d'un message\n";
	$choix = readline("Votre choix ? : ");

	if ($choix == "1"){
		GKey();
	} else if ($choix == "2"){
		MeCrypt();
	} else if ($choix == "3"){
		MeDeCrypt();
	}
}