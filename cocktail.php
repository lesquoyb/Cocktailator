<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");

$dataBase = connect();
$cocktail_manager = new cocktailManager($dataBase);
$cocktails = $cocktail_manager->all();

$cocktails[13]->toHtml();
?>