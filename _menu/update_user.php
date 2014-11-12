<?php
include("../php/functions.php");
include("../classes/userManager.class.php");

if (isSession('id', $id_user) && isPost('field', $field) && isPost('val', $value)) {
	$dataBase = connect();
	$user_manager = new userManager($dataBase);
	$user = $user_manager->getById($id_user);

	if ($field == "pseudo") {
		$user->_user_login = $value;
		$_SESSION['pseudo'] = $value;
		$user_manager->updateLogin($user);
	} elseif ($field == "password") {
		$user->_user_password = md5($value);
		$user_manager->updatePassword($user);
	} elseif ($field == "mail") {
		$user->_user_mail = $value;
		$user_manager->updateMail($user);
	} elseif ($field == "name") {
		$user->_user_name = $value;
		$user_manager->updateName($user);
	} elseif ($field == "firstname") {
		$user->_user_firstname = $value;
		$user_manager->updateFirstname($user);
	} elseif ($field == "ddn") {
		$user->_user_birthday = $value;
		$user_manager->updateBirthday($user);
	} elseif ($field == "sex") {
		$user->_user_sex = $value;
		$user_manager->updateSex($user);
	} elseif ($field == "street") {
		$user->_user_address = $value;
		$user_manager->updateAddress($user);
	} elseif ($field == "cp") {
		$user->_user_post_code = $value;
		$user_manager->updateCP($user);
	} elseif ($field == "town") {
		$user->_user_town = $value;
		$user_manager->updateTown($user);
	} elseif ($field == "tel") {
		$user->_user_phone_num = $value;
		$user_manager->updatePhoneNum($user);
	}
}
?>