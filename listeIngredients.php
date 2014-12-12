
<?php 
require_once 'php/functions.php';
include 'classes/IngredientManager.class.php';
function dessiner(Ingredient $arbre){
	echo "<ul>";
	$temp = $arbre;
	echo "<li>";
	echo $temp->_name;
	echo "</li>";
	if ($temp->_enfants != NULL){
		foreach ($temp->_enfants as $key => $value) {
			dessiner($value);
		}
	
	}
	echo "</ul>";

}



foreach(IngredientManager::getHierarchy(connect()) as $racine){
	//var_dump($racine);
	dessiner($racine); 
} 

var_dump(IngredientManager::getHierarchy(connect()));


?>