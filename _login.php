<?php 
include("php/functions.php");

$err = '';
$dataBase = connect();
$query = $dataBase->prepare("SELECT id_player FROM player WHERE pl_name = ?");
$query->execute(array($pseudo));

if (isPost('pseudo', $pseudo) && isPost('password', $password)) {

	$query = $dataBase->prepare("SELECT id_user FROM user WHERE user_name = ?");
	$query->execute(array($pseudo));
	if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
		$query = $dataBase->prepare("SELECT id_user FROM user WHERE user_name = ? AND user_password = ?");
		$query->execute(array($pseudo, md5($password)));
		if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
			$favorite = array();
			$query = $dataBase->query("SELECT id_cocktail FROM has_favorite_cocktail WHERE id_user = ".$id);
			while (list($id_cocktail) = $query->fetch(PDO::FETCH_NUM)) $favorite[] = $id_cocktail;
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['id'] = $id;
			$_SESSION['favorite'] = serialize($favorite);
		} else $err = 'password';
	} else $err = 'login';

	if ($err !== '') {
		$err = '?error='.$err;
		header("Location: /Cocktailator/".$err);
	} else header("Location: /Cocktailator/home.php");
	
} else header("Location: /Cocktailator/".$err);

?>