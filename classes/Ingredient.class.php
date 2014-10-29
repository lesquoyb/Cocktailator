<?php

class Ingredient {

	public $_name;
	public $_id;

	public function __construct($id,$name){
		$this->_name = $name;
		$this->_id = $id;
	}

}