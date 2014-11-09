
<!-- Top menu -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container" style="height:70px;">
		<div class="navbar-header"><img onclick="location = '/Cocktailator'" style="height: 70px;" src="Graphics/logo.png"/></div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Cocktails <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a onclick="$('.middle_container').load('/Cocktailator/list_cocktail.php');">Afficher les cocktails</a></li>
						<li><a href="#">Proposer un Cocktail</a></li>
						<li class="divider"></li>
						<li><a onclick="$('.middle_container').load('/Cocktailator/favoris.php');">Mes favoris</a></li>
					</ul>
				<li><a href="#">Ingrédients</a></li>
			</ul>

			<div class='dropdown' style="float:right;margin-top:6px;">
				<?php if ( isSession('id', $id) ) { ?>
					<button class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown' href='#' style='font-size:15px;width:100%;'>
						<?= $_SESSION[ 'pseudo' ]; ?> <span class='caret'></span>
					</button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
						<li role='presentation'><a role='menuitem' tabindex='-1' onclick="showInfo()"><span class="glyphicon glyphicon-off"></span> Mon compte</a></li>
						<li role='presentation'><a role='menuitem' tabindex='-1' href='/Cocktailator/_logout.php'><span class="glyphicon glyphicon-off"></span> Se déconnecter</a></li>
					</ul>
				<?php } else { 
					if (!isSession('favorite')) $_SESSION['favorite'] = serialize(array()); ?>
					<button class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown' href='#' style='font-size:15px;width:100%;'>
						Login <span class='caret'></span>
					</button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
						<li role='presentation'><a role='menuitem' tabindex='-1' onclick="$('.middle_container').load('/Cocktailator/_index/login.php');"><span class="glyphicon glyphicon-off"></span> Se connecter</a></li>
						<li role='presentation'><a role='menuitem' tabindex='-1' onclick="$('.middle_container').load('/Cocktailator/_index/register.php');"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
					</ul>
				<?php } ?>
			</div>
			
		</div>
	</div>
</nav>

<!-- GESTION DU COMPTE -->
<div class="modal fade" style="margin-top:70px;" id="myInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
				<h4 class="modal-title" id="myModalLabel">Mon compte</h4>
			</div><div id="modal_info" class="modal-body bag">
				Chargement de vos informations...
			</div><div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<script>
	function showInfo() {
		$('#myInfo').modal('show');
		$('#modal_info').load('_menu/account.php');
	}
</script>