<?php
require_once("php/functions.php");
require_once("classes/IngredientManager.class.php");

$iMan = new IngredientManager(connect());

isPost("id_ing", $id_ing, $iMan->getSuperId());

$ing = $iMan->all();
$ing[$id_ing]->toHtml($ing);
?>