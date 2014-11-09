
<!-- Top menu -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container" style="height:70px;">
		<div class="navbar-header"><img onclick="location = '/Cocktailator/home.php'" style="height: 70px;" src="Graphics/logo.png"/></div>
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
				<button class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown' href='#' style='font-size:15px;width:100%;'>
					<?php 
						if(isset($_SESSION['pseudo'])){
							echo $_SESSION[ 'pseudo' ];
						}
						else{
							?>
							<button onclick="se_connecter();">Se connecter</button>
							<?php
						} 
						?> <span class='caret'></span>
				</button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
					<li role='presentation'><a role='menuitem' tabindex='-1' href='/Cocktailator/_logout.php'><span class="glyphicon glyphicon-off"></span> Se déconnecter</a></li>
				</ul>
			</div>
			
		</div>
	</div>
</nav>