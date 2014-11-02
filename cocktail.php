<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");


if (isPost('id_cocktail', $id_cocktail)) {
	$dataBase = connect();
	$cocktail_manager = new cocktailManager($dataBase);
	$cocktails = $cocktail_manager->selectWhere(array( "id_cocktail" => $id_cocktail));
	
	$cocktails[0]->toHtml();
} else {
	script("$('.middle_container').load('/Cocktailator/home.php');");
}
?>