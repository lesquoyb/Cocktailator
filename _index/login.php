<div style='width: 400px;margin: auto;margin-top: 80px;border: 3px solid #6A7AE3;border-radius: 5px;background: radial-gradient(rgba(255, 255, 255, 0), rgba(31, 20, 142, 0.1));padding: 10px;'>
	<form action="_login.php" method="post" style="padding:10px;border-radius:0px 10px 10px 10px;text-align:center;" class="form-horizontal" role="form">
		<div id="div_pseudo" class="form-group has-feedback">
			<label for="pseudo" class="col-sm-4 control-label">Login</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Login" required />
				<span class="glyphicon form-control-feedback"></span>
				<label for="pseudo" class="control-label"></label>
			</div>
		</div>
		<div id="div_password" class="form-group has-feedback">
			<label for="password" class="col-sm-4 control-label">Mot de passe</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="password" name="password" placeholder="********" required />
				<span class="glyphicon form-control-feedback"></span>
				<label for="password" class="control-label"></label>
			</div>
		</div>
		<button type="submit" style="width:90px;" class="btn btn-default">Connexion</button>
	</form>
</div>