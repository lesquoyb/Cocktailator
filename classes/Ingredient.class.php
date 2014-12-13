<?php
include_once 'cocktailManager.class.php';

class Ingredient {

	public $_name;
	public $_id;
	public $_racine;
	public $_enfants;
	public $_parents;

	public function __construct($id,$name,$racine,$enfants){
		$this->_name = $name;
		$this->_id = $id;
		$this->_racine = $racine;
		$this->_enfants = $enfants;
	}

	
	public function getChildren(){
		return $this->_enfants;
	}

	
	public function getLowerElement($all) {
		$res = array();
		if (count($this->_enfants) != 0) {
			// Big recursive
			for ($i = 0; $i < count($this->_enfants); $i ++) {
				foreach ($all[$this->_enfants[$i]]->getLowerElement($all) as $lower_elements) $res[$lower_elements] = $lower_elements;
			}
			return $res;
		} else return array($this->_id);
	}
	
	public function drawHierarchy($all) {
		$test = "";
		$ids = "";
		if  ( ( $this->_parents != NULL )  && (count($this->_parents[0]) != 0) ) $parent_id = $this->_parents[0];
		else $parent_id = -1;
		while ($parent_id != -1) {
			$test = $all[$parent_id]->_name.";".$test;
			$ids = $parent_id.";".$ids;
			if ( ( $all[$parent_id]->_parents != NULL )  && (count($all[$parent_id]->_parents[0]) != 0) ) $parent_id = $all[$parent_id]->_parents[0];
			else $parent_id = -1;
		}
		$test = explode(";", $test);
		$ids = explode(";", $ids);
		
		echo '<ol class="breadcrumb">';
		for ($i = 0; $i < count($test) -1; $i++) echo '<li><a onclick=\'$(".middle_container").load("/Cocktailator/ingredients.php", {id_ing : '.$ids[$i].'});\'>'.$test[$i].'</a></li>';
		echo '<li class="active">'.$this->_name.'</li></ol>';
	}
	
	public function toHtml($all) {
		$this->drawHierarchy($all, $this->_id);
		echo "<ul class='nav nav-pills nav-justified nav_ingredients' role='tablist'>";			
		foreach($all[$this->_id]->_enfants as $id_child) echo '<li><a onclick=\'$(".middle_container").load("/Cocktailator/ingredients.php", {id_ing : '.$id_child.'});\'>'.$all[$id_child]->_name.'</a></li>';
		echo "</ul>";
		$cocMan = new cocktailManager(connect());
		$cocktails = $cocMan->allContainingIngredients($all[$this->_id]->getLowerElement($all));
		foreach ($cocktails as $cocktail) $cocktail->resume();
	}

}