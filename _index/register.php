<?php
include("../php/functions.php");

$dataBase = connect();
$query = $dataBase->query("SELECT user_name, user_mail FROM user");

$list_mail = "";
$list_name = "";
while(list($name, $mail) = $query->fetch(PDO::FETCH_NUM)) {
	if ($list_name != '') $list_name .= ',';
	$list_name .= "'".md5(trim($name))."'";
	if ($list_mail != '') $list_mail .= ',';
	$list_mail .= "'".md5(trim($mail))."'";
}
script('var names = new Array('.$list_name.'); var mails = new Array('.$list_mail.');');
?>

	<ul class="nav nav-tabs nav-justified" role="tablist">
		<li style="cursor:pointer;"><a onclick="$('#enter').load('_index/login.php');">Connexion</a></li>
		<li class="active"><a style="background-color:#333D6A;color:black;border: 1px solid #333D6A;">Enregistrement</a></li>
	</ul>
	<form action="_register.php" method="post" style="background-color:#333D6A;padding:10px;border-radius:10px 0px 10px 10px;color:#000" role="form">
		<div id="div_pseudo" class="form-group has-feedback">
			<label for="pseudo" class="control-label">Pseudo</label>
			<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value=' ' autocomplete=off required>
			<span class="glyphicon form-control-feedback"></span>
			<label for="pseudo" class="control-label"></label>
		</div><div id="div_password" class="form-group has-feedback">
			<label for="password" class="control-label">Mot de passe</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="*******" autocomplete=off required>
			<span class="glyphicon form-control-feedback"></span>
			<label for="password" class="control-label"></label>
		</div><div id="div_mail" class="form-group has-feedback">
			<label for="mail" class="control-label">E-mail</label>
			<input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse E-mail" autocomplete=off required>
				<span class="glyphicon form-control-feedback"></span>
				<label for="mail" class="control-label"></label>
		</div><div class="form-group" style="text-align:center;">
			<button id="signin" type="submit" class="btn btn-default">S'enregistrer</button>
		</div>
	</form>
<script>
	var error_pseudo = true;
	var error_mail = true;
	$('#signin').addClass('disabled');
	setTimeout(function() { $('#pseudo').val(''); }, 100);
	
	$('#pseudo').keyup(function() {
		$(this).val($(this).val().trim());
		if ((names.indexOf(calcMD5($(this).val())) == -1) && (hasMinMax($(this).val(), 3, 21)) ) {
			$('#div_pseudo').addClass('has-success').removeClass('has-error');
			$('#div_pseudo > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_pseudo > label:last-child').html('');
			error_pseudo = false;
		} else {
			$('#div_pseudo').addClass('has-error').removeClass('has-success');
			$('#div_pseudo > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (names.indexOf(calcMD5($(this).val())) != -1) $('#div_pseudo > label:last-child').html('Ce pseudo est déjà utilisé.');
			else if (lg < 4) $('#div_pseudo > label:last-child').html('Votre pseudo doit comporter entre 4 et 20 caractères. Il vous en manque ' + (4 - lg) + '.');
			else $('#div_pseudo > label:last-child').html('Votre pseudo doit comporter entre 4 et 20 caractères. Vous devez en retirer ' + (lg - 20) + '.');
			error_pseudo = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
	
	$('#password').keyup(function() {
		$(this).val($(this).val().trim());
		if (hasMinMax($(this).val(), 5, 21)) {
			$('#div_password').addClass('has-success').removeClass('has-error');
			$('#div_password > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_password > label:last-child').html('');
			error_password = false;
		} else {
			$('#div_password').addClass('has-error').removeClass('has-success');
			$('#div_password > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 6) $('#div_password > label:last-child').html('Votre mot de passe doit comporter entre 6 et 20 caractères. Il vous en manque ' + (6 - lg) + '.');
			else $('#div_password > label:last-child').html('Votre mot de passe doit comporter entre 6 et 20 caractères. Vous devez en retirer ' + (lg - 20) + '.');
			error_password = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});

	$('#mail').keyup(function() {
			$(this).val($(this).val().trim());
		arobase = $(this).val().indexOf('@');
		dot = $(this).val().indexOf('.');
		if ( (mails.indexOf(calcMD5($(this).val().trim())) == -1) && (arobase != -1) && (dot != -1) ) {
			$('#div_mail').addClass('has-success').removeClass('has-error');
			$('#div_mail > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_mail > label:last-child').html('');
			error_mail = false;
		} else {
			$('#div_mail').addClass('has-error').removeClass('has-success');
			$('#div_mail > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			if (arobase == -1) $('#div_mail > label:last-child').html('Cette adresse mail est incorrecte, il manque un "@".');
			else if (dot == -1) $('#div_mail > label:last-child').html('Cette adresse mail nest incorrecte, il manque un ".".');
			else $('#div_mail > label:last-child').html('Cette adresse mail est déjà liée à un compte.');
			error_mail = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
</script>