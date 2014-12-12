<?php

class Ingredient {

	public $_name;
	public $_id;
	public $_racine;
	public $_enfants;

	public function __construct($id,$name,$racine,$enfants){
		$this->_name = $name;
		$this->_id = $id;
		$this->_racine = $racine;
		$this->_enfants = $enfants;
	}

	
	public function getChildren(){
		return $this->_enfants;
	}


}