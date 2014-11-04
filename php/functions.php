<?php
session_set_cookie_params (86400); // dure une journ�e
session_start();
session_regenerate_id();

//$url_begin = "http://localhost:82/la-ccr";

// Include des fonctions personnelles
include(dirname(__FILE__)."/../Heyleon/php/include.php");


//Affiche toutes les erreurs d'une requ�te
function afficheErreursPDO($requete){
	$infos = $requete->errorInfo();
	foreach($infos as $key => $value){
		echo "$key  $value  <br/>";
	}
	var_export($infos, TRUE);
}

// V�rification de connexion
function onlyRegistered($admin=false){
	if ( !isSession('id', $id) ) {
		// N'est pas connect�
		header("Location: /Cocktailator/?error=disconnected");
		exit;
	} elseif ($admin && !isAdmin() ) {
		// N'est pas admin
		header("Location: /Cocktailator/?error=protected");
		exit;
	}
}

// V�rifie si l'utilisateur est Admin
function isAdmin($id='') {
	if ($id == '') isSession('id',$id, '');
	return ( in_array($id, array(0,1)) );
}

// Connexion � la Base de Donn�es
function connect(){
	try {
		$dataBase = new PDO("mysql:host=localhost;dbname=cocktailator", 'root', ''); // connexion � la BDD
		$dataBase->exec("SET CHARACTER SET utf8");
		return $dataBase;
	} catch ( Exception $e ) {
		echo "Connection � MySQL impossible : ", $e->getMessage();
		die();
	}
}

function getPictureFor($name) {
	return "/Cocktailator/data/Photos/".getPictureNameFor($name);
}

function getPictureNameFor($name) {
	return ucfirst(strtolower(str_replace(array(':', "'", '"', ' '), array('', '', '', '_'), stripAccents($name)))).'.jpg';
}

function getMaxId($dataBase, $table, $attr) {
	$query = $dataBase->query("SELECT ".$attr." FROM ".$table." ORDER BY ".$attr." ASC");
	if ($query->rowCount() == 0) return 0;
	else {
		while( list($id) = $query->fetch(PDO::FETCH_NUM) ) {
			$ids[] = $id;
		}
		return maxId($ids);
	}
}
?>
