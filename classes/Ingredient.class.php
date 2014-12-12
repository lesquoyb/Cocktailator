<?php

class Ingredient {

	public $_name;
	public $_id;
	public $_parents;
	public $_enfants;

	public function __construct($id,$name,$parents,$enfants){
		$this->_name = $name;
		$this->_id = $id;
		$this->_parents = $parents;
		$this->_enfants = $enfants;
	}


	/*
	* Ajoute un enfant + modifie l'enfant pour qu'il ai un parent de plus.
	*/
	public function addChild(Ingredient $child){
		$this->_enfants[] = $child;
		$child->_parents[] = $this;
	}
	public function removeChild(Ingredient $child){
		$key = 0;
		foreach ($this->_enfants as $key => $value) {
			if ($value->_id == $child->_id){
				break;
			}
		}
		unset($this->_enfants[$key]);
	}

	/*
	* Ajoute un parent + modifie le parent pour qu'il ai un enfant de plus.
	*/
	public function addParent(Ingredient $parent){
		$this->_parents[] = $parent;
		$parent->_enfants[] = $this;
	}
	public function removeParent(Ingredient $parent){
		$key = 0;
		foreach ($this->_parents as $key => $value) {
			if ($value->_id == $parent->_id){
				break;
			}
		}
		unset($this->_parents[$key]);
	}
	public function getChildren(){
		return $this->_enfants;
	}
	public function getParents(){
		return $this->_parents;
	}


}