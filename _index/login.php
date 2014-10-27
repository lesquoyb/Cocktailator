<ul class="nav nav-tabs nav-justified" role="tablist">
	<li class="active"><a style="background-color:#333D6A;color:#000;border: 1px solid #333D6A;">Connexion</a></li>
	<li style="cursor:pointer;"><a onclick="$('#enter').load('_index/register.php');">Enregistrement</a></li>
</ul>
<form action="_login.php" method="post" style="background-color:#333D6A;padding:10px;border-radius:0px 10px 10px 10px;" class="form-inline" role="form">
	<div class="input-span" style="width:100%;">
		<input type="text" style="width:calc(50% - 45px);" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" required>
		<input type="password" style="width:calc(50% - 45px);" class="form-control" id="password" name="password" placeholder="******" required>
		<button type="submit" style="width:90px;" class="btn btn-default">Connexion</button>
	</div>
</form>