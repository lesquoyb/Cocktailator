<?php

class User{
	
	public $_id;
	public $_user_login;
	public $_user_name;
	public $_user_password;
	public $_user_mail;
	public $_user_firstname;
	public $_user_sex;
	public $_user_birthday;
	public $_user_address;
	public $_user_post_code;
	public $_user_town;
	public $_user_phone_num;

	public function __construct($id, $login, $pass,  $name = NULL, $mail= NULL, $firstname =NULL, $sex =NULL, $birthday =NULL, $address =NULL, $post_code =NULL, $town =NULL, $phone_num =NULL){
		$this->_id = $id;
		$this->_user_login = $login;
		$this->_user_name = $name;
		$this->_user_password = $pass;
		$this->_user_mail = $mail;
		$this->_user_firstname = $firstname;
		$this->_user_sex = $sex;
		$this->_user_birthday = $birthday;
		$this->_user_address = $address;
		$this->_user_post_code = $post_code;
		$this->_user_town = $town;
		$this->_user_phone_num = $phone_num;
	}
	
	public function getPhoneNum() {
		return $this->_user_phone_num;
	}
}