<?php

require_once "classes/userManager.class.php";
require_once "php/functions.php";
if (isset($_POST["titre"]) and isset($_POST["commentaire"]) and isset($_POST["auteur"]) and isset($_POST["cocktail"]) ) {
	$man = new UserManager(connect());
	$man->addComment($_POST["titre"],$_POST["commentaire"],$_POST["auteur"],$_POST["cocktail"]);

}



