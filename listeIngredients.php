
<?php 
require_once 'php/functions.php';
include 'classes/IngredientManager.class.php';
function dessiner(Ingredient $arbre){
	echo "<tr>";
	$temp = $arbre;
	echo $temp->_ing_name;
	if ($temp->_enfants != NULL){
		foreach ($temp->_enfants as $key => $value) {
			echo "<td>";
			dessiner($value);
			echo "</td>";
		}
	}

	echo "</tr>";

}
echo "<table>";
/*
foreach(IngredientManager::getHierarchy(connect()) as $racine){
	var_dump($racine);
	dessiner($racine);
} 
*/
var_dump(IngredientManager::getHierarchy(connect()));
echo "</table>";

?>