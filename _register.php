<?php 
include("php/functions.php");
require_once("classes/userManager.class.php");

if (isPost('pseudo', $pseudo) && isPost('password', $password) ) {
	$dataBase = connect();

	isPost('mail', $mail, '');
	isPost('name', $name, '');
	isPost('firstname', $firstname, '');
	isPost('ddn', $ddn, '');
	isPost('sex', $sex, '');
	isPost('street', $street, '');
	isPost('cp', $cp, '');
	isPost('town', $town, '');
	isPost('tel', $tel, '');
	
	$query = $dataBase->prepare("SELECT * FROM user WHERE user_login = ?");
	$query->execute(array($pseudo));
	if ($query->rowCount() != 0) {
		header("Location: /Cocktailator/?error=pseudo_exist");
		exit();
	}
	if ( (strlen($pseudo) > 20) || (strlen($pseudo) < 4) ) {
		header("Location: /Cocktailator/?error=pseudo_len");
		exit();	
	}
	
	if ( (strlen($password) > 20) || (strlen($password) < 6) ) {
		header("Location: /Cocktailator/?error=password_len");
		exit();	
	}
	
	if ($mail != '') {
		$query = $dataBase->prepare("SELECT * FROM user WHERE user_mail = ?");
		$query->execute(array($mail));
		if ($query->rowCount() != 0) {
			header("Location: /Cocktailator/?error=mail_exist");
			exit();
		}
	}

	if ($tel != '') {	
		$query = $dataBase->prepare("SELECT * FROM user WHERE user_phone_num = ?");
		$query->execute(array($tel));
		if ($query->rowCount() != 0) {
			header("Location: /Cocktailator/?error=tel_exist");
			exit();
		}
	}
	

	// Création du compte
	$user_manager = new userManager($dataBase);
	$query = $dataBase->prepare("INSERT INTO user VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$id_user = getMaxId($dataBase, 'user', 'id_user');
	$query->execute(array($id_user, $pseudo, $name, md5($password), $mail, $firstname, $sex, $ddn, $street, $cp, $town, $tel));
	$_SESSION['pseudo'] = $pseudo;
	$_SESSION['id'] = $id_user;

	// Ajout des favoris déjà sélectionnés
	$favorite = unserialize($_SESSION['favorite']);
	foreach($favorite as $fav) { $user_manager->addFavorite($id_user, $fav); }

} else header("Location: /Cocktailator/?error=no_completed");

header("Location: /Cocktailator/?action=registered");
?>