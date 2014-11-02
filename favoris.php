<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");
onlyRegistered();

$dataBase = connect();
$cocktail_manager = new cocktailManager($dataBase);
$cocktails = $cocktail_manager->all();
$favorite = unserialize($_SESSION['favorite']);

if (count($favorite) > 0) foreach($favorite as $id_favorite) $cocktails[$id_favorite]->resume();
else echo "<div class='middle_message'>Vous n'avez encore ajouté aucun cocktail à vos favoris.</div>";
?>