<?php
include("../php/functions.php");
include("../classes/userManager.class.php");

if (isPost("password", $password)) {
	$dataBase = connect();
	$user_manager = new userManager($dataBase);
	$user = $user_manager->getById($_SESSION['id']);
	$query = $dataBase->prepare("SELECT * FROM user WHERE id_user = :id AND user_password = :password");
	$query->bindValue(':id', $_SESSION['id']);
	$query->bindValue(':password', md5($password));
	$query->execute();
	
	if ($query->rowCount() != 0) {
		script('$(".middle_container").load("/Cocktailator/_menu/account.php");');
	} else {
		script('$(".middle_container").load("/Cocktailator/_menu/secure_account.php?err=password");');
	}
}
?>


