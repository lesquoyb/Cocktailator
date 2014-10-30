<?php
require_once 'DAO.interface.php';
require_once 'has_ingredient.class.php';

class Has_ingredientManager{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}


	/*
	* Insert un objet dans la bdd
	*/
	public function insert( $objet){
		if ($objet instanceof Has_ingredient){
			$req = "INSERT INTO has_ingredient (id_cocktail,id_ingredient) VALUES (:cocktail,:ingredient)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":ingredient",$objet->_id_ingredient);
			$query->bindValue(":cocktail",$objet->_id_cocktail);
			$query->execute();
		}

	}


	/*
	* supprime un objet dans la bdd
	*/
	public function delete( $objet){
		if ($objet instanceof Has_ingredient){

		}
	}


	/*
	* modifie un objet dans la bdd
	*/
	public function change( $objetDepart, $objetFinal){
		if (($objetDepart instanceof Has_ingredient) and ( $objetFinal instanceof Has_ingredient)){
			
		}
	}


	/*
	* renvoie tous les objet de la table
	*/
	public function all(){

	}


	/*
	* Effectue une selection sur la table selon les critères passés en paramètre
	*/
	public function selectWhere(array $criteres){
			//TODO à verifier que ça fonctionne bien
			$conditions = "";
			$retour = [];
			foreach ($criteres as $key => $value) {
				$conditions = $conditions . "$key = :$key AND";
			}
			$conditions = rtrim($conditions,"AND");

			$req = "SELECT * FROM  has_ingredient WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$retour[] = new Has_ingredient($value['id_cocktail'],$value["id_ingredient"]);
			}
			return $retour;
	}
}