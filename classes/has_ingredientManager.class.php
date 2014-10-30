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
			$req = "DELETE FROM has_ingredient WHERE id_ingredient = :id_ing AND id_cocktail = :id_cock";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_ing",$objet->_id_ingredient);
			$query->bindValue(":id_cock",$objet->_id_cocktail);
			$query->execute();
		}
	}


	/*
	* modifie un objet dans la bdd
	*/
	public function update( $objetDepart, $objetFinal){
		if (($objetDepart instanceof Has_ingredient) and ( $objetFinal instanceof Has_ingredient)){
			$req = "UPDATE has_super_categ SET id_ingredient = :id, id_cocktail = :id_cock WHERE id_ingredient = :id_prem AND id_cocktail = :id_cock_prem ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id_ingredient);
			$query->bindValue(":id_cock_prem",$objetFinal->_id_cocktail);
			$query->bindValue(":id",$objetFinal->_id_ingredient);
			$query->bindValue(":id_cock",$objetFinal->_id_cocktail);
			$query->execute();
		}
	}


	/*
	* renvoie tous les objet de la table
	*/
	public function all(){
		$req = "SELECT * FROM has_ingredient";
		$query->execute();
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$ret[] = new Has_ingredient($value["id_cocktail"],$value["id_ingredient"]);
		}
		return $ret;
	}


	/*
	* Effectue une selection sur la table selon les critères passés en paramètre
	*/
	public function selectWhere(array $criteres){
			$conditions = "";
			$retour = [];
			foreach ($criteres as $key => $value) {
				$conditions = $conditions . "$key = :$key AND ";
			}
			$conditions = rtrim($conditions,"AND ");

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