<?php
require_once "has_favorite_cocktail.class.php";
require_once "DAO.interface.php";

class Has_favorite_cocktailManager implements DAO{
	

	private $_db;


	public function __construct(PDO $db){
		$this->_db = $db;
	}

	public function insert( $objet){
		if ($objet instanceof Has_favorite_cocktail){
			$req = "INSERT INTO has_favorite_cocktail VALUES (:user,:cock)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":user",$objet->_id_user);
			$query->bindValue(":cock",$objet->_id_cocktail);
			$query->execute();
		}
	}

	public function delete($objet){
		if( $objet instanceof Has_favorite_cocktail){
			$req = "DELETE FROM has_favorite_cocktail WHERE id_user = :user AND id_cocktail = :cock";
			$query = $this->_db->prepare($req);			
			$query->bindValue(":user",$objet->_id_user);
			$query->bindValue(":cock",$objet->_id_cocktail);
			$query->execute();
		}
	}

	public function update($objetDepart, $objetFinal){
		if (($objetDepart instanceof Has_favorite_cocktail) and ( $objetFinal instanceof Has_favorite_cocktail)){
			$req = "UPDATE Has_favorite_cocktail SET id_user = :user, id_cocktail = :cock WHERE id_user = :user_p AND id_cocktail = :cock_p ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":user_p",$objet->_id_user);
			$query->bindValue(":cock_p",$objet->_id_cocktail);
			$query->bindValue(":user",$objet->_id_user);
			$query->bindValue(":cock",$objet->_id_cocktail);
			$query->execute();
		}
	}

	public function all(){
			$req = "SELECT * FROM has_favorite_cocktail";
			$query = $this->_db->prepare($req);
			$query->execute();
			$ret = [];
			foreach ($query->fetchAll() as $key => $value) {
				$ret[] = new Has_favorite_cocktail($value["id_user"],$value["id_cocktail"]);
			}
			return $ret;
	}

	public function selectWhere(array $criteres){
			$conditions = "";
			$retour = [];
			foreach ($criteres as $key => $value) {
				$conditions = $conditions . "$key = :$key AND ";
			}
			$conditions = rtrim($conditions,"AND ");
			$req = "SELECT * FROM has_favorite_cocktail WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$retour[] = new Has_favorite_cocktail($value["id_user"],$value["id_cocktail"]);
			}
			return $retour;
	}

}