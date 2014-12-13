<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");


if (isPost('id_cocktail', $id_cocktail)) {
	$dataBase = connect();
	$cocktail_manager = new cocktailManager($dataBase);
	$cocktails = $cocktail_manager->selectWhere(array( "id_cocktail" => $id_cocktail));
	
	$cocktails[0]->toHtml();
	if (isSession('id',$id)){
		?>
			<div class="nouveauCommentaire">
				<input id="nouvtitre" type="text"/>
				<textarea id="nouvCom" />
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
