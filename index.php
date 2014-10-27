<?php
include("php/functions.php");
if (isSession('id')) header("Location: ".$url_begin."/general.php");
?>

<head>
	<meta charset="utf-8">
	<meta name="title" content="la CCR, Jeu de stratégie en ligne multi-joueur">
	<meta name="description" content="Jeu de stratégie en ligne">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link type="image/png" href="Graphics/icon.png" rel="icon">
	<?php getCss(); ?>
	<script src="js/jquery.js"></script>
	<script async src="js/bootstrap.min.js "></script>
	<script async src="js/function.js "></script>
	<script async src="dewplayer/swfobject.js"></script>
	<script async src="js/md5.js"></script>
	<title>La CCR</title>
	<meta name="keywords" content="online, game, CCR, ascaze">
	<meta name="robots" content="index, nofollow" >
</head>

</body>

<a href="https://plus.google.com/113769301152675255860" rel="publisher"></a>

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
		<h4 style="text-align:center;font-size:20px;text-decoration:underline;">Bienvenue sur La-CCR !</h4>
		<p>Ce site est un jeu de stratégie en ligne, en cours de développement. Vous pouvez vous y inscrire gratuitement, et profiterez d'une version Alpha en ligne.</p>
	</div>
	<div class="sheet" id="enter" style="width:40%;margin:auto;margin-top:5%;">
		<!-- REMPLISSAGE AUTOMATIQUE -->
	</div>
	<div style="margin:auto;width:70%;color:#fff;font-size:18px;margin-top:3%;text-shadow: 1px 1px black;">
		<h4 style="text-align:center;font-size:20px;text-decoration:underline;">Tenez-vous à jour de l'avancement du site !</h4>
		<p>Toutes les fonctionnalités n'ont pas encore été réalisées. Lors de la réalisation de nouvelles fonctions, il se peut que le jeu aie besoin de réinitialiser certains paramètres. Pour ne pas 
		perdre du temps et des ressources, consultez le tableau de bord une fois connecté pour y trouver des conseils, s'il y en a.</p>
	</div>
	<script>
		<?php if (in_array($err, array('pseudo_exist','mail_exist') ) ) echo "$('#enter').load('_index/register.php');";
		else echo "$('#enter').load('_index/login.php');"; ?>
	</script>
</body>