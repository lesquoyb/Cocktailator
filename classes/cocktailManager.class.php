<?php
require_once 'cocktail.class.php';
require_once 'DAO.interface.php';

class CocktailManager implements DAO{
	
	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}


	/*
	* Insert un objet dans la bdd
	*/
	public function insert( $objet){
		if ($objet instanceof Cocktail){
			$req = "INSERT INTO cocktail (id_cocktail,cocktail_name,cocktail_require,cocktail_step) VALUES (:id,:name,:require,:step)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->bindValue(":name",$objet->_cocktail_name);
			$query->bindValue(":require",$objet->_cocktail_require);
			$query->bindValue(":step",$objet->_cocktail_step);
			$query->execute();
		}

	}


	/*
	* supprime un objet dans la bdd
	*/
	public function delete( $objet){
		if ($objet instanceof Cocktail){
			$req = "DELETE FROM cocktail WHERE id_cocktail = :id ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->execute();
		}
	}


	/*
	* modifie un objet dans la bdd
	*/
	public function update( $objetDepart, $objetFinal){
		if (($objetDepart instanceof Cocktail) and ( $objetFinal instanceof Cocktail)){
			$req = "UPDATE user SET id_cocktail = :id, cocktail_name = :name, cocktail_require = :req, cocktail_step  = :step WHERE id_cocktail = :id_prem ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id);
			$query->bindValue(":id",$objetFinal->_id);
			$query->bindValue(":name",$objetFinal->_cocktail_name);
			$query->bindValue(":req",$objetFinal->_cocktail_step);
			$query->bindValue(":step",$objetFinal->_cocktail_require);
			$query->execute();
		}
	}


	/*
	* renvoie tous les objet de la table
	*/
	public function all(){
		$req = "SELECT * FROM cocktail";
		$query->execute();
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$ret[] = new Cocktail($value["id_cocktail"],$value["cocktail_name"],$value["cocktail_require"],$value["cocktail_step"]);
		}
		return $ret;
	}

	/*
	* Renvoie l'id correspondant au nom passé en paramètre
	*/
	public function getIdByName($name){
		$req = "SELECT id_Cocktail FROM cocktail WHERE cocktail_name = :name";
		$query = $this->_db->prepare($req);
		$query->bindValue(":name",$name);
		$query->execute();
		$res = $query->fetch();
		return $res["id_cocktail"];
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

			$req = "SELECT * FROM  cocktail WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$retour[] = new Cocktail($value["id_Cocktail"],$value["cocktail_name"],$value["cocktail_require"],$value["cocktail_step"]);
			}
			return $retour;
	}

}