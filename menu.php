
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
				<li><a onclick="$('.middle_container').load('/Cocktailator/ingredients.php');">Ingrédients</a></li>
			</ul>
			
			<a href="#" style="float:right;margin-top:15px;margin-left:30px;" data-toggle="modal" data-target="#contact">Nous contacter</a>
			
			<div class='dropdown' style="float:right;margin-top:6px;">
				<?php if ( isSession('id', $id) ) { ?>
					<button class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown' href='#' style='font-size:15px;width:100%;'>
						<?= $_SESSION[ 'pseudo' ]; ?> <span class='caret'></span>
					</button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
						<li role='presentation'><a role='menuitem' tabindex='-1' onclick="$('.middle_container').load('/Cocktailator/_menu/secure_account.php');"><span class="glyphicon glyphicon-book"></span> Mon compte</a></li>
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

<div id="contact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titre" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="titre">Nous contacter</h4>
      </div>
      <div class="modal-body">
      	Message:<br/>
        <textarea style="width=auto;heigth:auto;" cols="60" rows="30">
        </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <a type="button" class="btn btn-primary" data-dismiss="modal" href="mailto:adresse@mail.com">Envoyer</a>
      </div>
    </div>
  </div> 
</div>
