<?php
session_set_cookie_params (86400); // dure une journée
session_start();
session_regenerate_id();

//$url_begin = "http://localhost:82/la-ccr";

// Include des fonctions personnelles
include(dirname(__FILE__)."/../Heyleon/php/include.php");


// Vérification de connexion
function onlyRegistered($admin=false){
	if ( !isSession('id', $id) ) {
		// N'est pas connecté
		header("Location: ".$url_begin."/?error=disconnected");
		exit;
	} elseif ($admin && !isAdmin() ) {
		// N'est pas admin
		header("Location: ".$url_begin."/?error=protected");
		exit;
	}
}

// Vérifie si l'utilisateur est Admin
function isAdmin($id='') {
	if ($id == '') isSession('id',$id, '');
	return ( in_array($id, array(0,1)) );
}

// Connexion à la Base de Données
function connect(){
	try {
		$dataBase = new PDO("mysql:host=localhost;dbname=cocktailator", 'root', ''); // connexion à la BDD
		$dataBase->exec("SET CHARACTER SET utf8");
		return $dataBase;
	} catch ( Exception $e ) {
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();
	}
}
?>