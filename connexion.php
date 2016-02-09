<?php
require_once('config/dbconf.php');

//On essai de se connecter à la BDD
try
{
	// Connexion à la base de données
	$database = new PDO($config['host'],
	               $config['user'],
	               $config['password']);

	// Configuration du pilote : nous voulons des exceptions
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Obligatoire pour la suite
}
catch(Exception $e)
{
	echo "Échec : " . $e->getMessage();
}

if($database==true){
	echo("Connecté");
}else{
	echo('HE NON !');
}
