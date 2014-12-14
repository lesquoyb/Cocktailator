<script src="_commentaires.js"></script>
<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");
require_once("classes/userManager.class.php");

if (isPost('id_cocktail', $id_cocktail)) {

	if (isset($_POST["titre"]) and isset($_POST["commentaire"]) and isset($_POST["auteur"]) and isset($_POST["id_cocktail"]) ) {
	$man = new UserManager(connect());
	$man->addComment($_POST["titre"],$_POST["commentaire"],$_POST["auteur"],$_POST["id_cocktail"]);

}

	$dataBase = connect();
	$cocktail_manager = new cocktailManager($dataBase);
	$cocktails = $cocktail_manager->selectWhere(array( "id_cocktail" => $id_cocktail));
	
	$cocktails[0]->toHtml();
	if (isSession('id',$id)){
		echo $id_cocktail;
		?>
			<div class="nouveauCommentaire">
				<input id="nouvtitre" type="text" class="hidden" value="a">
				<textarea id="nouvCom" class="form-control" rows="3" style="width:96%;margin:auto;"></textarea>
				<input style="visibility:hidden;" id='auteur' value="<?= $id ?>" />
				<input style="visibility:hidden;" id='cocktail' value="<?= $id_cocktail ?>" />
				<button id="valider" onclick="ajouterCommentaire();" >Valider</button>
			</div>
	
		<?php
	}
} else {
	script("$('.middle_container').load('/Cocktailator/home.php');");
}
?>
