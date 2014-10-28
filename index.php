<?php
require_once("php/functions.php");
?>
<head>
	<meta charset="utf-8">
	<meta name="title" content="la CCR, Jeu de stratégie en ligne multi-joueur">
	<meta name="description" content="Jeu de stratégie en ligne">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link type="image/png" href="Graphics/icon.png" rel="icon">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link href="css/bootstrap-modif.css" rel="stylesheet">
	<link href="Heyleon/css/heyleon.css" rel="stylesheet">
	<link href="css/general.css" rel="stylesheet">
	<link href="css/chat.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script async src="js/bootstrap.min.js "></script>
	<script async src="js/md5.js"></script>
	<title>Cocktailator</title>
	<meta name="keywords" content="online, game, CCR, ascaze">
	<meta name="robots" content="index, nofollow" >
</head>

</body>

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
	} elseif ($err == 'expire') {
		$title_error = "Session expirée :";
		$text_error = "Vous avez été déconnecté automatiquement, connectez-vous pour continuer.";
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
		$text_action = "Votre enregistrement a bien été pris en compte. Un mail vient d'être envoyé à l'adresse renseignée sur le formulaire.";
	} 
	echo '<div class="success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>'.$title_action.'</h4>'.$text_action.'</div>';
}
echo "</div>";
?>

	<div style="margin:auto;width:70%;color:#fff;font-size:18px;text-shadow: 1px 1px black;">
		<h4 style="text-align:center;font-size:20px;text-decoration:underline;">Bienvenue sur Cocktailator !</h4>
		<p>C'est un site superbe !</p>
	</div>
	<div class="sheet" id="enter" style="width:40%;margin:auto;margin-top:5%;">
		<!-- REMPLISSAGE AUTOMATIQUE -->
	</div>

	<script>
		<?php if (in_array($err, array('pseudo_exist','mail_exist') ) ) echo "$('#enter').load('_index/register.php');";
		else echo "$('#enter').load('_index/login.php');"; ?>
	</script>
</body>