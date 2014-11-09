<?php 
require_once("../php/functions.php");
require_once("../classes/userManager.class.php");
onlyRegistered();

if (isPost('id_cocktail', $id_cocktail)) {
	// Suppression à la session
	$favorite = unserialize($_SESSION['favorite']);
	unset($favorite[$id_cocktail]);
	$_SESSION['favorite'] = serialize($favorite);
	
	if (isSession('id', $id)) {
		$dataBase = connect();
		$user_manager = new userManager($dataBase);
		
		$user_manager->removeFavorite($id, $id_cocktail);
	}
}

?>