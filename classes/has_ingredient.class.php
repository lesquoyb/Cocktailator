<?php

class Has_ingredient{
	


	public $_id_ingredient;
	public $_id_cocktail;

	public function __construct($id_cocktail,$id_ingredient){
		$this->_id_ingredient = $id_ingredient;
		$this->_id_cocktail = $id_cocktail;
	}

}