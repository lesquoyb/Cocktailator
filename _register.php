<?php 
include("php/functions.php");

if (isPost('pseudo', $pseudo) && isPost('password', $password) && isPost('mail', $mail) ) {

	$dataBase = connect();
	$query = $dataBase->prepare("SELECT * FROM user WHERE user_name = ?");
	$query->execute(array($pseudo));
	if ($query->rowCount() == 0) {
		$query = $dataBase->prepare("SELECT * FROM user WHERE user_mail = ?");
		$query->execute(array($mail));
		if ($query->rowCount() == 0) {
			// Création du compte
			$query = $dataBase->prepare("INSERT INTO user VALUES(?, ?, ?, ?)");
			$query->execute(array(getMaxId($dataBase, 'user', 'id_user'), $pseudo, md5($password), $mail));
		} else {
			header("Location: /Cocktailator/index.php?error=mail_exist");
			exit();
		}
	} else {
		header("Location: /Cocktailator/index.php?error=pseudo_exist");
		exit();
	}
} else header("Location: /Cocktailator/index.php?action=no_completed");

header("Location: /Cocktailator/index.php?action=registered");
?>