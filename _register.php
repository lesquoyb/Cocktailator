<?php 
include("php/functions.php");

$dataBase = connect();
$pseudo = strToData($_POST['pseudo']);
$password = md5(strToData($_POST['password']));
$mail = strToData($_POST['mail']);

if (isPost('pseudo', $pseudo) && isPost('password', $password) && isPost('mail', $mail) ) {

	$query = $dataBase->query("SELECT * FROM user WHERE user_name = '".$pseudo."'");
	if ($query->rowCount() == 0) {
		$query = $dataBase->query("SELECT * FROM user WHERE user_mail = '".$mail."'");
		if ($query->rowCount() == 0) {
			// Création du compte
			$query = $dataBase->query("INSERT INTO user VALUES(".getMaxId($dataBase, 'user', 'id_user').", '".$pseudo."', '".md5($password)."', '".$mail."')");
		} else {
			header("Location: /Cocktailator/index.php?error=mail_exist");
			exit();
		}
	} else {
		header("Location: /Cocktailator/index.php?error=pseudo_exist");
		exit();
	}
}

header("Location: /Cocktailator/index.php?action=registered");
?>