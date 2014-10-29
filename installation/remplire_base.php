<meta charset='utf-8'/>
<?php
include "../data/Donnees.inc.php";
include "../php/functions.php";
include "../classes/IngredientManager.class.php";
include '../classes/has_low_categManager.class.php';
include '../classes/has_super_categManager.class.php';

$dataBase = connect();
$ing_manager = new IngredientManager($dataBase);

$categories = [];
$i = 0;
foreach ($Hierarchie as $key => $value) {
	$ingr = new Ingredient($i,$key);
	//$ing_manager->insert($ingr);
	$categories[] = $value;
	$i++;
}

foreach ($categories as $key => $value) {

		foreach ($value as $keyCateg => $valueCateg) {
			if ($keyCateg === 'sous-categorie'){
				$manager = new Has_low_categManager($dataBase);
				foreach ($valueCateg as $keySous => $valueSous) {
					$id = $ing_manager->getIdByName($valueSous);
					//$ing = $ing_manager->selectWhere(array('ing_name' => $valueSous))[0];
					var_dump($id);
					echo "<br>";
					$categ = new Has_low_categ($keySous,$id);
					$manager->insert($categ);
				}
			}
			elseif ($keyCateg === 'super-categorie') {
				$manager = new Has_super_categManager($dataBase);	
				foreach ($valueCateg as $keySuper => $valueSuper) {
					$categ = new Has_super_categ($keySuper,$valueSuper);
					$manager->insert($categ);
				}
			}
	}
}
/*
foreach ($Recettes as $key => $value) {
	$titre = $value['titre'] ;
	$ingredients = $value['ingredients'];
	$preparation = $value['preparation'];
	$req = "INSERT INTO cocktail (cocktail_name,cocktail_require,cocktail_step) VALUES(:titre, :ingredients, :preparation) ";
	$index = $value["index"];
	$query = $dataBase->prepare($req);
	//var_dump($preparation);
	$query->bindValue(":titre",$titre);
	$query->bindValue(":ingredients", $ingredients);
	$query->bindValue(":preparation", $preparation);

	$cocktail = $query->execute();

	foreach ($index as $key => $valueIng) {
		var_dump($key);
		echo " ";
		var_dump($valueIng);
		echo "\n\r";
		$reqIngr =  "INSERT INTO has_ingredient (id_cocktail,id_ingredient) 
					 SELECT :cocktail, id_ingredient FROM ingredient WHERE ing_name = ':ingredient'";
		$query = $dataBase->prepare($reqIngr);
		$query->bindValue(":cocktail",$cocktail);
		$query->bindValue(":ingredient", $valueIng);
		$query->execute();
	}

}
*/

echo "cocktails ajoutés";