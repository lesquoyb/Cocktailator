<?php
include_once 'Ingredient.class.php';
include_once 'DAO.interface.php';
require_once (dirname(__FILE__) .'/../php/functions.php');

class IngredientManager implements DAO{
	
	private $_db;

	public function __construct(PDO $db){
		$this->_db = $db;
	}


	/*
	* Insert un objet dans la bdd
	*/
	public function insert( $objet){
		if ($objet instanceof Ingredient){
			$req = "INSERT INTO ingredient (id_ingredient,ing_name) VALUES (:id,:ing_name)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->bindValue(":ing_name",$objet->_name);
			$query->execute();
		}

	}


	/*
	* supprime un objet dans la bdd
	*/
	public function delete( $objet){
		if ($objet instanceof Ingredient){
			$req = "DELETE FROM ingredient WHERE id_ingredient = :id";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->execute();
		}
	}


	/*
	* modifie un objet dans la bdd
	*/
	public function update( $objetDepart, $objetFinal){
		if (($objetDepart instanceof Ingredient) and ( $objetFinal instanceof Ingredient)){
			$req = "UPDATE ingredient SET id_ingredient = :id, ing_name = :name WHERE id_ingredient = :id_prem ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id);
			$query->bindValue(":id",$objetFinal->_id);
			$query->bindValue(":name",$objetFinal->_user_name);
			$query->execute();
		}
	}


	/*
	* renvoie tous les objet de la table
	*/
	public function all(){
		$req = "SELECT * FROM ingredient";
		$query = $this->_db->prepare($req);
		$query->execute();
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$ret[] = new Ingredient($value["id_ingredient"],$value["ing_name"]);
		}
		return $ret;
	}

	/*
	* Renvoie l'id correspondant au nom passé en paramètre
	*/
	public function getIdByName($name){
		$req = "SELECT id_ingredient FROM ingredient WHERE ing_name = :name";
		$query = $this->_db->prepare($req);
		$query->bindValue(":name",$name);
		$query->execute();
		$res = $query->fetch();
		return $res["id_ingredient"];
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

			$req = "SELECT * FROM ingredient WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$retour[] = new Ingredient($value["id_ingredient"],$value["ing_name"]);
			}
			return $retour;
	}




	/*
	*	Renvoie la liste des ingrédients qui compose un ingrédient
	*/
	public function isComposedBy(){
		$ret = [];
		$query = $this->_db->prepare("SELECT * FROM ingredient i, has_low_categ h WHERE h.id_ingredient = i.id_ingredient AND h.id_ingredient = $this->_id");
		$query->execute();
		foreach ($query->fetchAll() as $key => $value) {
			$ret[] = new Ingredient($value["id_ingredient"],$value["ing_name"]);
		}
		return $ret;
	}




	public static function getHierarchy($db){
		$query = $db->prepare("SELECT * FROM ingredient");
		$query->execute();
		$hier = [];
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$hier[$value["id_ingredient"]] = new Ingredient($value["id_ingredient"],$value["ing_name"],true,NULL);
		}

		// On liste tous les enfants de chaque élément
		$query = $db->prepare("SELECT h.id_ingredient,h.id_super_categ,i.ing_name FROM has_super_categ h,ingredient i WHERE h.id_super_categ = i.id_ingredient");
		$query->execute();
		foreach ($query->fetchAll() as $key => $value) {
				$hier[$value["id_ingredient"]]->_racine = false; 
				$hier[$value["id_super_categ"]]->_enfants[] = &$hier[$value["id_ingredient"]];//on référence ici uniquement les index pour l'instant
		}

		// On cherche les racines
		foreach ($hier as $key => $value) {
			if($value->_racine === true){
				$ret[] = $value;
			}
		}
		return $ret;
	}

}