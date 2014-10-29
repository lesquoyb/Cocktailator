<?php
require_once "has_super_categ.class.php";
require_once "DAO.interface.php";

class Has_super_categManager implements DAO{
	

	private $_db;


	public function __construct(PDO $db){
		$this->_db = $db;
	}

	public function insert( $objet){
		if ($objet instanceof Has_super_categ){
			$req = "INSERT INTO has_super_categ (id_ingredient,id_super_categ) VALUES (:ing,:categ)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":ing",$objet->_id_ingredient);
			$query->bindValue(":categ",$objet->_id_super_categ);
			$query->execute();
		}
	}

	public function delete($objet){

	}

	public function change($objetDepart, $objetFinal){

	}

	public function all(){

	}

	public function selectWhere(array $criteres){

	}

}