<?php

class User{
	
	public $_id;
	public $_user_name;
	public $_user_password;
	public $_user_mail;
	public $_favorite_cocktails;

	public function __construct($id,$name,$pass,$mail, $favorite_cocktails){
		$this->_id = $id;
		$this->_user_name = $name;
		$this->_user_password = $pass;
		$this->_user_mail = $mail;
		$this->_favorite_cocktails = $favorite_cocktails;
	}
}