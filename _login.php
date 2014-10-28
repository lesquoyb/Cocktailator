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
		$query = $dataBase->prepare("SELECT id_user FROM user WHERE user_name = ? AND pl_password = ?");
		$query->execute(array($pseudo, md5($password)));
		if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['id'] = $id;
		} else $err = 'password';
	} else $err = 'login';

	if ($err !== '') {
		$err = '?error='.$err;
		header("Location: /Cocktail/".$err);
	} else header("Location: /Cocktail/general.php");
	
} else header("Location: /Cocktail/".$err);

?>