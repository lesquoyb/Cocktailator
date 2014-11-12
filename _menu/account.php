<?php
include("../php/functions.php");
include("../classes/userManager.class.php");

$dataBase = connect();
$user_manager = new userManager($dataBase);
$user = $user_manager->getById($_SESSION['id']);
$query = $dataBase->query("SELECT user_name, user_mail, user_phone_num FROM user WHERE id_user != ".$_SESSION['id']);

$list_mail = "";
$list_name = "";
$list_phone = "";
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
			margin-bottom:0px;
		}
		.form-control-static {
			border-bottom: 1px solid rgba(161, 161, 161, 0.55);
			min-height: 34px;
		}
		[pinput]:hove {
			border: 1px solid #ccc;
			border-radius: 4px;
			padding: 3px 8px;
			height: 30px;
		}
	</style>

	<form class="form-horizontal" role="form" style="padding:30px 200px;">
		<div id="div_pseudo" class="form-group has-feedback">
			<label for="pseudo" class="col-sm-3 control-label">Login</label>
			<div class="col-sm-9">
				<p class="form-control-static" type='text' id="pseudo" pinput><?= $user->_user_login ?></p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="pseudo" class="control-label"></label>
			</div>
		</div><div id="div_password" class="form-group has-feedback">
			<label for="password" class="col-sm-3 control-label">Mot de passe</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="password" id="password" pinput>Modifier mon mot de passe</p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="password" class="control-label"></label>
			</div>
		</div><div id="div_mail" class="form-group has-feedback">
			<label for="mail" class="col-sm-3 control-label">E-mail</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="email" id="mail" pinput><?= $user->_user_mail ?></p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="mail" class="control-label"></label>
			</div>
		</div><div id="div_name" class="form-group has-feedback">
			<label for="name" class="col-sm-3 control-label">Nom</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="text" id="name" pinput><?= $user->_user_name ?><p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="name" class="control-label"></label>
			</div>
		</div><div id="div_firstname" class="form-group has-feedback">
			<label for="firstname" class="col-sm-3 control-label">Prénom</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="text" id="firstname" pinput><?= $user->_user_firstname ?></p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="firstname" class="control-label"></label>
			</div>
		</div><div id="div_ddn" class="form-group has-feedback">
			<label for="ddn" class="col-sm-3 control-label">Date de naissance</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="date" id="ddn" pinput><?= $user->_user_birthday ?></p>
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
					<p type="text" style="width:50%;padding: 8px 10px;" class="form-control-static" id="street" pinput><?= $user->_user_address ?></p>
					<p type="text" style="width: 70px;padding: 8px 10px;" class="form-control-static" id="cp" pinput><?= $user->_user_post_code ?></p>
					<p type="text" style="width: calc(50% - 64px);padding: 8px 10px;" class="form-control-static" id="town"pinput><?= $user->_user_town ?></p>
				</div>
				<span class="glyphicon form-control-feedback"></span>
				<label for="address" class="control-label"></label>
			</div>
		</div><div id="div_tel" class="form-group has-feedback">
			<label for="tel" class="col-sm-3 control-label">Numéro de téléphone</label>
			<div class="col-sm-9">
				<p class="form-control-static" type="tel" id="tel" pinput><?= $user->_user_phone_num ?></p>
				<span class="glyphicon form-control-feedback"></span>
				<label for="tel" class="control-label"></label>
			</div>
		</div>
	</form>

<?php script("$('#sex').val('".$user->_user_sex."');"); ?>
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
	
	$("#sex").change(function() {
		$.post("/Cocktailator/_menu/update_user.php", { field : "sex", val : $(this).val() });
	});
	
	function pToInput(arg) {
		if (arg == undefined) arg = $("[pinput]");
		else arg = $("#" + arg);
		arg.click(function() {
			var id = $(this).attr('id');
			if ($(this).attr('type') == "password") {
				$(this).html("");
			}
			$(this).replaceWith("<input type='" + $(this).attr('type') + "' style='" + $(this).attr('style') + "' id='" + id + "' class='form-control' inputp value='" + $(this).html() +  "' autocomplete='off' />");
			$("#" + id).focus();
			inputToP(id);
			setRule(id);
		});
	}
	
	function inputToP(arg) {
		if (arg == undefined) arg = $("[inputp]");
		else arg = $("#" + arg);
		arg.focusout(function() {
			var val = $(this).val();
			var type = $(this).attr('type');
			$.post("/Cocktailator/_menu/update_user.php", { field : $(this).attr('id'), val : val });
			if (type == "password") {
				val = "Mot de passe changé";
			}
			$(this).replaceWith("<p type='" + $(this).attr('type') + "' style='" + $(this).attr('style') + "' id='" + $(this).attr('id') + "' class='form-control-static' pinput>" + val + "</p>");
			pToInput($(this).attr("id"));
		});
	}
	
	pToInput();
	
	function canRegister() {
		if (error_pseudo || error_mail || error_password || error_name || error_firstname || error_tel || error_ddn) { $('#signin').hide('slow'); }
		else { $('#signin').show('slow'); }
	}
	
	$("input").keyup(function() {
		if ($(this).val() != $(this).val().trim()) $(this).val($(this).val().trim());
	});
	
	function setRule(id) {
	
		if (id == "pseudo") {
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
		}
	
		if (id == "password") {
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
		}

		if (id == "mail") {
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
		}
			
		if (id == "name") {
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
		}
		
		if (id == "firstname") {
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
		}

		if (id == "tel") {
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
					else $('#div_tel >  div > label:last-child').html('Ce numéro a déjà été utilisé pour un autre compte.');
					error_tel = true;
				}
				canRegister();
			});
		}

		if (id == "ddn") {
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
		}
	};
</script>