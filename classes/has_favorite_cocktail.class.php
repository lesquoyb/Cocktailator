<?php


class Has_favorite_coctail{
	
	public $_id_user;
	public $_id_cocktail;

	public function __construct($id_user, $id_cocktail){
		$this->_id_user = $id_user;
		$this->_id_cocktail = $id_cocktail;
	}



}
