<?php
include("../php/functions.php");

$dataBase = connect();
$query = $dataBase->query("SELECT user_name, user_mail, user_phone_num FROM user");

$list_mail = "";
$list_name = "";
while(list($name, $mail, $phone) = $query->fetch(PDO::FETCH_NUM)) {
	if ($list_name != '') $list_name .= ',';
	$list_name .= "'".md5(trim($name))."'";
	if ($list_mail != '') $list_mail .= ',';
	$list_mail .= "'".md5(trim($mail))."'";
	if ($list_phone != '') $list_phone .= ',';
	$list_phone .= "'".md5(trim($phone))."'";
}
script('var names = new Array('.$list_name.'); var mails = new Array('.$list_mail.'); var phones = new Array('.$list_phone.');');
?>

	<style>
		sup {
			color: red;
		}
		.form-group {
			margin_bottom:0px;
		}
	</style>

<div style='width: 600px;margin: auto;margin-top: 30px;margin-bottom: 30px;border: 3px solid #6A7AE3;border-radius: 5px;background: radial-gradient(rgba(255, 255, 255, 0), rgba(31, 20, 142, 0.1));padding: 10px;'>
	<form action="_register.php" method="post" class="form-horizontal" role="form">
		<div id="div_pseudo" class="form-group has-feedback">
			<label for="pseudo" class="col-sm-3 control-label">Login <sup>*</sup></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value=' ' autocomplete=off required />
				<span class="glyphicon form-control-feedback"></span>
				<label for="pseudo" class="control-label"></label>
			</div>
		</div><div id="div_password" class="form-group has-feedback">
			<label for="password" class="col-sm-3 control-label">Mot de passe <sup>*</sup></label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="password" name="password" placeholder="*******" autocomplete=off required />
				<span class="glyphicon form-control-feedback"></span>
				<label for="password" class="control-label"></label>
			</div>
		</div><div id="div_mail" class="form-group has-feedback">
			<label for="mail" class="col-sm-3 control-label">E-mail</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse e-mail" autocomplete=off />
				<span class="glyphicon form-control-feedback"></span>
				<label for="mail" class="control-label"></label>
			</div>
		</div><div id="div_name" class="form-group has-feedback">
			<label for="name" class="col-sm-3 control-label">Nom</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" autocomplete=off />
				<span class="glyphicon form-control-feedback"></span>
				<label for="name" class="control-label"></label>
			</div>
		</div><div id="div_firstname" class="form-group has-feedback">
			<label for="firstname" class="col-sm-3 control-label">Prénom</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" autocomplete=off />
				<span class="glyphicon form-control-feedback"></span>
				<label for="firstname" class="control-label"></label>
			</div>
		</div><div id="div_ddn" class="form-group has-feedback">
			<label for="ddn" class="col-sm-3 control-label">Date de naissance</label>
			<div class="col-sm-9">
				<input type="date" class="form-control" id="ddn" name="ddn" placeholder="Votre date de naissance" autocomplete=off />
				<span class="glyphicon form-control-feedback"></span>
				<label for="ddn" class="control-label"></label>
			</div>
		</div><div id="div_sex" class="form-group">
			<label for="ddn" class="col-sm-3 control-label">Sexe</label>
			<div class="col-sm-9">
				<select class="form-control" id="sex" name="sex">
					<option value=""> </option>
					<option value="homme"> Homme </option>
					<option value="femme"> Femme </option>
				</select>
				<span class="glyphicon form-control-feedback"></span>
				<label for="ddn" class="control-label"></label>
			</div>
		</div><div id="div_address" class="form-group has-feedback">
			<label for="address" class="col-sm-3 control-label">Adresse</label>
			<div class="col-sm-9">
				<div class="input-span">
					<input type="text" style="width:50%;padding: 8px 10px;" class="form-control" id="street" name="street" placeholder="Rue" autocomplete=off>
					<input type="text" style="width: 70px;padding: 8px 10px;" class="form-control" id="cp" name="cp" placeholder="Code p." autocomplete=off>
					<input type="text" style="width: calc(50% - 64px);padding: 8px 10px;" class="form-control" id="town" name="town" placeholder="Ville" autocomplete=off>
				</div>
				<span class="glyphicon form-control-feedback"></span>
				<label for="address" class="control-label"></label>
			</div>
		</div><div id="div_tel" class="form-group has-feedback">
			<label for="tel" class="col-sm-3 control-label">Numéro de téléphone</label>
			<div class="col-sm-9">
			<input type="tel" class="form-control" id="tel" name="tel" placeholder="0312456789" autocomplete=off>
				<span class="glyphicon form-control-feedback"></span>
				<label for="tel" class="control-label"></label>
			</div>
		</div><div class="form-group" style="text-align:center;">
			<button id="signin" type="submit" style="display:none;" class="btn btn-default">S'enregistrer</button>
		</div>
	</form>
</div>
	
<script>
	var mail_reg = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
	var tel_reg = new RegExp("^(0|\\+33|0033)[1-9]{1}[0-9]{8}$");
	var error_pseudo = true;
	var error_password = true;
	var error_mail = false;
	var error_name = false;
	var error_firstname = false;
	var error_tel = false;
	var error_ddn = false;
	setTimeout(function() { $('#pseudo').val(''); }, 100);
	
	function canRegister() {
		if (error_pseudo || error_mail || error_password || error_name || error_firstname || error_tel || error_ddn) { $('#signin').hide('slow'); }
		else { $('#signin').show('slow'); }
	}
	
	$("input").keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
	});
	
	$('#pseudo').keyup(function() {
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
		canRegister();
	});
	
	$('#password').keyup(function() {
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
		canRegister();
	});

	$('#mail').keyup(function() {
		if ( (mails.indexOf(calcMD5($(this).val().trim())) == -1) && (mail_reg.test($(this).val())) || ($(this).val().length == 0) ) {
			$('#div_mail').addClass('has-success').removeClass('has-error');
			$('#div_mail > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_mail >  div > label:last-child').html('');
			error_mail = false;
		} else {
			$('#div_mail').addClass('has-error').removeClass('has-success');
			$('#div_mail > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			if (mail_reg.test($(this).val())) $('#div_mail >  div > label:last-child').html('Cette adresse mail est déjà liée à un compte');
			else $('#div_mail >  div > label:last-child').html('Cette adresse mail n\'est pas correcte.');
			error_mail = true;
		}
		
		canRegister();
	});
	
	$('#name').keyup(function() {
		if (hasMinMax($(this).val(), 2, 51) || ($(this).val().length == 0) ) {
			$('#div_name').addClass('has-success').removeClass('has-error');
			$('#div_name > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_name >  div > label:last-child').html('');
			error_name = false;
		} else {
			$('#div_name').addClass('has-error').removeClass('has-success');
			$('#div_name > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 3) $('#div_name >  div > label:last-child').html('Votre nom doit comporter entre 3 et 50 caractères. Il vous en manque ' + (3 - lg) + '.');
			else $('#div_name >  div > label:last-child').html('Votre mot de passe doit comporter entre 3 et 50 caractères. Vous devez en retirer ' + (lg - 50) + '.');
			error_name = true;
		}
		canRegister();
	});
	
	$('#firstname').keyup(function() {
		if (hasMinMax($(this).val(), 2, 51) || ($(this).val().length == 0) ) {
			$('#div_firstname').addClass('has-success').removeClass('has-error');
			$('#div_firstname > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_firstname >  div > label:last-child').html('');
			error_firstname = false;
		} else {
			$('#div_firstname').addClass('has-error').removeClass('has-success');
			$('#div_firstname > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 3) $('#div_firstname >  div > label:last-child').html('Votre prénom doit comporter entre 3 et 50 caractères. Il vous en manque ' + (3 - lg) + '.');
			else $('#div_firstname >  div > label:last-child').html('Votre prénom doit comporter entre 3 et 50 caractères. Vous devez en retirer ' + (lg - 50) + '.');
			error_firstname = true;
		}
		canRegister();
	});
	
	$('#tel').keyup(function() {
		if ( (phones.indexOf(calcMD5($(this).val().trim())) == -1) && tel_reg.test($(this).val()) ) {
			$('#div_tel').addClass('has-success').removeClass('has-error');
			$('#div_tel > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_tel >  div > label:last-child').html('');
			error_tel = false;
		} else {
			$('#div_tel').addClass('has-error').removeClass('has-success');
			$('#div_tel > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			lg = $(this).val().length;
			if (lg < 10) $('#div_tel >  div > label:last-child').html('Votre numéro doit comporter entre 10 et 14 caractères. Il vous en manque ' + (10 - lg) + '.');
			else if (phones.indexOf(calcMD5($(this).val().trim())) != -1) $('#div_tel >  div > label:last-child').html('Ce numéro a déjà été utilisé pour un autre compte.');
			else $('#div_tel >  div > label:last-child').html('Ce numéro n\'est pas valide.');
			error_tel = true;
		}
		canRegister();
	});
	
	$('#ddn').keyup(function() {
		if (hasMinMax($(this).val(), 9, 11) || ($(this).val().length == 0) ) {
			$('#div_ddn').addClass('has-success').removeClass('has-error');
			$('#div_ddn > span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
			$('#div_ddn >  div > label:last-child').html('');
			error_ddn = false;
		} else {
			$('#div_ddn').addClass('has-error').removeClass('has-success');
			$('#div_ddn > span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
			$('#div_ddn >  div > label:last-child').html('Vous devez entrer une date correcte au format JJ/MM/AAAA.');
			error_ddn = true;
		}
		canRegister();
	});
</script>