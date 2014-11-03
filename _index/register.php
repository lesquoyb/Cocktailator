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
	<form action="_register.php" method="post" class="form-horizontal" style="background-color:#333D6A;padding:10px;border-radius:10px 0px 10px 10px;color:#000" role="form">
		<div id="div_pseudo" class="form-group has-feedback">
			<label for="pseudo" class="col-sm-3 control-label">Login</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value=' ' autocomplete=off required>
				<span class="glyphicon form-control-feedback"></span>
				<label for="pseudo" class="control-label"></label>
			</div>
		</div><div id="div_password" class="form-group has-feedback">
			<label for="password" class="col-sm-3 control-label">Mot de passe</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="password" name="password" placeholder="*******" autocomplete=off required>
				<span class="glyphicon form-control-feedback"></span>
				<label for="password" class="control-label"></label>
			</div>
		</div><div id="div_mail" class="form-group has-feedback">
			<label for="mail" class="col-sm-3 control-label">E-mail</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse E-mail" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="mail" class="control-label"></label>
			</div>
		</div><div id="div_name" class="form-group has-feedback">
			<label for="name" class="col-sm-3 control-label">Nom</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="name" class="control-label"></label>
			</div>
		</div><div id="div_firstname" class="form-group has-feedback">
			<label for="firstname" class="col-sm-3 control-label">Prénom</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="firstname" class="control-label"></label>
			</div>
		</div><div id="div_ddn" class="form-group has-feedback">
			<label for="ddn" class="col-sm-3 control-label">Date de naissance</label>
			<div class="col-sm-9">
				<input type="date" class="form-control" id="ddn" name="ddn" placeholder="Votre date de naissance" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="ddn" class="control-label"></label>
			</div>
		</div><div id="div_address" class="form-group has-feedback">
			<label for="address" class="col-sm-3 control-label">Adresse</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="address" name="address" placeholder="Adresse postale" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="address" class="control-label"></label>
			</div>
		</div><div class="form-group" style="text-align:center;">
			<button id="signin" type="submit" class="btn btn-default">S'enregistrer</button>
		</div>
	</form>
	
	
<script>
	var error_pseudo = true;
	var error_password = true;
	var error_mail = false;
	$('#signin').addClass('disabled');
	setTimeout(function() { $('#pseudo').val(''); }, 100);
	
	$('#pseudo').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		if ((names.indexOf(calcMD5($(this).val())) == -1) && (hasMinMax($(this).val(), 3, 21)) ) {
			$('#div_pseudo').addClass('has-success').removeClass('has-error');
			$('#div_pseudo > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_pseudo >  div > label:last-child').html('');
			error_pseudo = false;
		} else {
			$('#div_pseudo').addClass('has-error').removeClass('has-success');
			$('#div_pseudo > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (names.indexOf(calcMD5($(this).val())) != -1) $('#div_pseudo > div > label:last-child').html('Ce pseudo est déjà utilisé.');
			else if (lg < 4) $('#div_pseudo > div > label:last-child').html('Votre pseudo doit comporter entre 4 et 20 caractères. Il vous en manque ' + (4 - lg) + '.');
			else $('#div_pseudo > div > label:last-child').html('Votre pseudo doit comporter entre 4 et 20 caractères. Vous devez en retirer ' + (lg - 20) + '.');
			error_pseudo = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
	
	$('#password').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		if (hasMinMax($(this).val(), 5, 21)) {
			$('#div_password').addClass('has-success').removeClass('has-error');
			$('#div_password > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_password >  div > label:last-child').html('');
			error_password = false;
		} else {
			$('#div_password').addClass('has-error').removeClass('has-success');
			$('#div_password > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 6) $('#div_password >  div > label:last-child').html('Votre mot de passe doit comporter entre 6 et 20 caractères. Il vous en manque ' + (6 - lg) + '.');
			else $('#div_password >  div > label:last-child').html('Votre mot de passe doit comporter entre 6 et 20 caractères. Vous devez en retirer ' + (lg - 20) + '.');
			error_password = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});

	$('#mail').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		arobase = $(this).val().indexOf('@');
		dot = $(this).val().indexOf('.');
		if ( (mails.indexOf(calcMD5($(this).val().trim())) == -1) && (arobase != -1) && (dot != -1) ) {
			$('#div_mail').addClass('has-success').removeClass('has-error');
			$('#div_mail > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_mail >  div > label:last-child').html('');
			error_mail = false;
		} else {
			$('#div_mail').addClass('has-error').removeClass('has-success');
			$('#div_mail > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			if (arobase == -1) $('#div_mail >  div > label:last-child').html('Cette adresse mail est incorrecte, il manque un "@".');
			else if (dot == -1) $('#div_mail >  div > label:last-child').html('Cette adresse mail nest incorrecte, il manque un ".".');
			else $('#div_mail >  div > label:last-child').html('Cette adresse mail est déjà liée à un compte.');
			error_mail = true;
		}
		
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
	
	$('#name').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		if (hasMinMax($(this).val(), 2, 51)) {
			$('#div_name').addClass('has-success').removeClass('has-error');
			$('#div_name > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_name >  div > label:last-child').html('');
			error_password = false;
		} else {
			$('#div_name').addClass('has-error').removeClass('has-success');
			$('#div_name > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 3) $('#div_name >  div > label:last-child').html('Votre nom doit comporter entre 3 et 50 caractères. Il vous en manque ' + (3 - lg) + '.');
			else $('#div_name >  div > label:last-child').html('Votre mot de passe doit comporter entre 3 et 50 caractères. Vous devez en retirer ' + (lg - 50) + '.');
			error_name = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
	
	$('#firstname').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		if (hasMinMax($(this).val(), 2, 51)) {
			$('#div_firstname').addClass('has-success').removeClass('has-error');
			$('#div_firstname > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_firstname >  div > label:last-child').html('');
			error_password = false;
		} else {
			$('#div_firstname').addClass('has-error').removeClass('has-success');
			$('#div_firstname > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 3) $('#div_firstname >  div > label:last-child').html('Votre prénom doit comporter entre 3 et 50 caractères. Il vous en manque ' + (3 - lg) + '.');
			else $('#div_firstname >  div > label:last-child').html('Votre mot de passe doit comporter entre 3 et 50 caractères. Vous devez en retirer ' + (lg - 50) + '.');
			error_firstname = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
	
	$('#ddn').keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
		if (hasMinMax($(this).val(), 9, 11)) {
			$('#div_ddn').addClass('has-success').removeClass('has-error');
			$('#div_ddn > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_ddn >  div > label:last-child').html('');
			error_password = false;
		} else {
			$('#div_ddn').addClass('has-error').removeClass('has-success');
			$('#div_ddn > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			$('#div_ddn >  div > label:last-child').html('Vous devez entrer une date correcte au format JJ/MM/AAAA.');
			error_ddn = true;
		}
		if (error_pseudo || error_mail || error_password) { $('#signin').addClass('disabled'); }
		else { $('#signin').removeClass('disabled'); }
	});
</script>