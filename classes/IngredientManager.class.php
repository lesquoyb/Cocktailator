<?php
include_once 'Ingredient.class.php';
include_once 'DAO.interface.php';
include_once '../php/functions.php';

class IngredientManager implements DAO{
	
	private $_db;

	public function __construct(PDO $db){
		$this->_db = $db;
	}

	public function insert( $objet){
		if ($objet instanceof Ingredient){
			$req = "INSERT INTO ingredient (id_ingredient,ing_name) VALUES (:id,:ing_name)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->bindValue(":ing_name",$objet->_name);
			$query->execute();
			$objet->_id = $this->_db->lastInsertId();
		}

	}

	public function delete( $objet){
		if ($objet instanceof Ingredient){

		}
	}

	public function change( $objetDepart, $objetFinal){
		if (($objetDepart instanceof Ingredient) and ( $objetFinal instanceof Ingredient)){
			
		}
	}

	public function all(){

	}

	/*
	* Renvoie l'id correspondant au nom passé en paramètre
	*/
	public function getIdByName($name){
		//TODO, NE FONCTIONNE PAS
		// pourtant la requête passe dans phpmyadmin, mais fetch retourne false
		$req = "SELECT id_ingredient FROM ingredient WHERE ing_name = ':name'";
		echo $name;
		$query = $this->_db->prepare($req);
		$query->bindValue(':name',$name);
		$query->execute();
		afficheErreursPDO($query);
		return $query->fetch(PDO::FETCH_ASSOC)['id_ingredient'];
	}

	public function selectWhere(array $criteres){
			/// Ne fonctionne pas pour l'instant :(
			//TODO
			$conditions = "";
			$retour = [];
			foreach ($criteres as $key => $value) {
				$conditions = $conditions . "$key = ':$key' AND";
			}
			$conditions = rtrim($conditions,"AND");

			$req = "SELECT * FROM ingredient WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			echo $query->queryString . "<br>";
			$query->execute();
			afficheErreursPDO($query);
			var_dump($query->fetchAll());
			foreach ($query->fetchAll() as $key => $value) {
				var_dump($value);
				echo "<br>";
				$retour[] = new Ingredient($value["id_ingredient"],$value["ing_name"]);
			}
			return $retour;
	}

}