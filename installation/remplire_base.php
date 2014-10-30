<meta charset='utf-8'/>
<?php
include "../data/Donnees.inc.php";
include "../php/functions.php";
include "../classes/IngredientManager.class.php";
include '../classes/has_low_categManager.class.php';
include '../classes/has_super_categManager.class.php';
include '../classes/cocktailManager.class.php';
include '../classes/has_ingredientManager.class.php';
	

$dataBase = connect();
$ing_manager = new IngredientManager($dataBase);

////////////////////////////
// AJOUT DES INGRÉDIENTS //
///////////////////////////
$categories = [];
$i = 0;
foreach ($Hierarchie as $key => $value) {
	$ingr = new Ingredient($i,$key);
	$ing_manager->insert($ingr);
	$categories[] = array( $i => $value );
	$i ++;
}

/////////////////////////////////////////////////////////////////
// AJOUT DES SOUS-CATÉGORIES ET SUPER-CATÉGORIES D'INGRÉDIENTS //
/////////////////////////////////////////////////////////////////
foreach ($categories as $key => $value) {
	foreach ($value as $key2 => $value2) {
		$id_ing = $key2;
		foreach ($value2 as $keyCateg => $valueCateg) {
			if ($keyCateg === 'sous-categorie'){
				$manager = new Has_low_categManager($dataBase);
				foreach ($valueCateg as $keySous => $valueSous) {
					$id_categ = $ing_manager->getIdByName($valueSous);
					$categ = new Has_low_categ($id_ing,$id_categ);
					$manager->insert($categ);
				}
			}
			elseif ($keyCateg === 'super-categorie') {
				$manager = new Has_super_categManager($dataBase);	
				foreach ($valueCateg as $keySuper => $valueSuper) {
					$id_categ = $ing_manager->getIdByName($valueSuper);
					$categ = new Has_super_categ($id_ing,$id_categ);
					$manager->insert($categ);
				}
			}
	}
		}	
}


$cockMan = new CocktailManager($dataBase);
$has_ingMan = new Has_ingredientManager($dataBase);
//////////////////////////////////////////////////////////////
/// AJOUT DES COCKTAILS ET DES INGRÉDIENTS QUI LES COMPOSES //
//////////////////////////////////////////////////////////////
foreach ($Recettes as $keyCock => $value) {
	
	$cocktail = new Cocktail($keyCock,$value['titre'], $value['ingredients'],$value['preparation']);
	$cockMan->insert($cocktail);

	$index = $value["index"];

	foreach ($index as $keyIng => $valueIng) {

		$has_ingredient = new Has_ingredient($keyCock,$ing_manager->getIdByName($valueIng));
		$has_ingMan->insert($has_ingredient);

	}
}

echo "cocktails ajoutés";