<?php 
require_once("../php/functions.php");
require_once("../classes/userManager.class.php");

if (isPost('id_cocktail', $id_cocktail)) {
	// Ajout à la session
	$favorite = unserialize($_SESSION['favorite']);
	$favorite[$id_cocktail] = $id_cocktail;
	$_SESSION['favorite'] = serialize($favorite);

	if (isSession('id',$id)) {
		$dataBase = connect();
		$user_manager = new userManager($dataBase);
	
		$user_manager->addFavorite($id, $id_cocktail);
	}
}

?>