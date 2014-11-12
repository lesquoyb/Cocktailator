<div style="height: 200px;text-align: center;margin-top:80px;">
	<input type="password" id="password" placeholder="Entrez votre mot de passe" style="width:220px;" /><br/>
	<br />
	<button onclick="secure();">Accéder à mes informations</button>
</div>

<script>
	function secure() {
		$(".middle_container").load("/Cocktailator/_menu/validate_secure_account.php", { password : $("#password").val() });
	}
</script>