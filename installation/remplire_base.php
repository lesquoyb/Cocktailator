<meta charset='utf-8'/>
<?php
include "../data/Donnees.inc.php";
include "../php/functions.php";
require_once "../classes/IngredientManager.class.php";
require_once'../classes/cocktailManager.class.php';
	
/// CREATION BDD
$dbh = new PDO("mysql:host=localhost", 'root', '');
$base = file_get_contents("cocktailator.sql");
$dbh->exec($base);


$dataBase = connect();
$ing_manager = new IngredientManager($dataBase);



////////////////////////////
// AJOUT DES INGRÉDIENTS //
///////////////////////////
$categories = [];
$i = 0;
$ingredients = [];
foreach ($Hierarchie as $key => $value) {
	$ingr = new Ingredient($i,$key);
	$ingredients[$key] = $ingr;
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

				foreach ($valueCateg as $keySous => $valueSous) {
					$id_categ = $ingredients[$valueSous]->_id;
					$ing_manager->insertLowCateg($id_ing,$id_categ);
				}
			}
			elseif ($keyCateg === 'super-categorie') {

				foreach ($valueCateg as $keySuper => $valueSuper) {
					$id_categ = $ingredients[$valueSuper]->_id;
					$ing_manager->insertSuperCateg($id_ing,$id_categ);
				}
			}
		}
	}	
}



//////////////////////////////////////////////////////////////
/// AJOUT DES COCKTAILS ET DES INGRÉDIENTS QUI LES COMPOSES //
//////////////////////////////////////////////////////////////
$cockMan = new CocktailManager($dataBase);
foreach ($Recettes as $keyCock => $value) {
	
	$cocktail = new Cocktail($keyCock,$value['titre'], $value['ingredients'],$value['preparation'],array());
	$cockMan->insert($cocktail);

	$index = $value["index"];

	foreach ($index as $keyIng => $valueIng) {
		$cockMan->ajouterIngredient($keyCock,$ingredients[$valueIng]->_id);
	}
}

echo "cocktails ajoutés";