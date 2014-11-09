<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");
require_once("classes/userManager.class.php");

$dataBase = connect();
$cocktail_manager = new cocktailManager($dataBase);
$cocktails = $cocktail_manager->all();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="Cocktailator, tout simplement">
	<meta name="description" content="Recettes de cocktails en ligne">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/png" href="/Cocktailator/Graphics/icon.png" rel="icon">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Amaranth">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link href="Heyleon/css/heyleon.css" rel="stylesheet">
	<link href="css/general.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script async src="js/functions.js"></script>
	<script async src="js/bootstrap.min.js "></script>
	<script async src="js/md5.js"></script>
	<title>Cocktailator</title>
	<meta name="keywords" content="cocktail, ator">
	<meta name="robots" content="index, nofollow" >
</head>

<body>
<?php include("menu.php"); ?>

<div class="box">
	<?php
	if (isGet('error', $err)) {
		if ($err == 'login') {
			$title_error = "Compte incorrect :";
			$text_error = "Personne ne s'est inscrit avec ce pseudo.";
		} elseif ($err == 'password') {
			$title_error = "Compte incorrect :";
			$text_error = "Le mot de passe saisi est incorrect.";
		} elseif ($err == 'pseudo_exist') {
			$title_error = "Données utilisées :";
			$text_error = "Le pseudo entré est déjà utilisé.";
		} elseif ($err == 'mail_exist') {
			$title_error = "Données utilisées :";
			$text_error = "L'adresse mail entrée est déjà liée à un compte.";
		} elseif ($err == 'pseudo_len') {
			$title_error = "Données non valides :";
			$text_error = "Votre pseudo doit comporter 4 à 20 lettres.";
		} elseif ($err == 'password_len') {
			$title_error = "Données non valides :";
			$text_error = "Votre mot de passe doit comporter 6 à 20 lettres.";
		} elseif ($err == 'mail_invalid') {
			$title_error = "Données non valides :";
			$text_error = "Votre adresse mail n'est pas valide.";
		} elseif ($err == 'expire') {
			$title_error = "Session expirée :";
			$text_error = "Vous avez été déconnecté automatiquement, connectez-vous pour continuer.";
		} elseif ($err == 'no_completed') {
			$title_error = "Formulaire incomplet :";
			$text_error = "Vous n'avez pas rempli tous les champs du formulaire1.";
		} elseif ($err == 'disconnected') {
			$title_error = "Authentification requise :";
			$text_error = "Vous devez vous connecter pour accéder à cette page !";
		} elseif ($err == 'protected') {
			$title_error = "Authentification requise :";
			$text_error = "Vous n'êtes pas autorisés à accéder à cette page.";
		} else {
			$title_error = "Erreur détectée :";
			$text_error = "Une erreur a eu lieu lors de l'authentification. Nom de l'erreur : <strong>".$err."</strong>";
		}
		echo '<div class="alert fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>'.$title_error.'</h4>'.$text_error.'</div>';
	}
	if (isGet('action', $action)) {
		if ($action == 'registered') {
			$title_action = "Enregistrement réussi :";
			$text_action = "Votre enregistrement a bien été pris en compte.";
		} 
		echo '<div class="success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>'.$title_action.'</h4>'.$text_action.'</div>';
	}
	?>
</div>

	<div class="middle_container">
		<?php
		$cocktail_user = new userManager($dataBase);
		var_dump($cocktail_user->getById($_SESSION['id']));
		
		if (in_array($err, array('login', 'password')) ) script("$('.middle_container').load('/Cocktailator/_index/login.php?error=".$err."');");
		elseif (!in_array($err, array('', 'protected', 'disconected', 'expire')) ) script("$('.middle_container').load('/Cocktailator/_index/register.php?error=".$err."');");
		else {
			$random_cocktails = array_rand($cocktails, 8);
			foreach ($random_cocktails as $key) $cocktails[$key]->resume();
		}
		?>
	</div>

</body>
</html>