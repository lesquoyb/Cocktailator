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
		if( $objet instanceof Has_super_categ){
			$req = "DELETE FROM has_super_categ WHERE id_ingredient = :id_ing AND id_super_categ = :id_cat";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_ing",$objet->_id_ingredient);
			$query->bindValue(":id_cat",$objet->_id_super_categ);
			$query->execute();
		}
	}

	public function update($objetDepart, $objetFinal){
		if (($objetDepart instanceof Has_super_categ) and ( $objetFinal instanceof Has_super_categ)){
			$req = "UPDATE has_super_categ SET id_ingredient = :id, id_super_categ = :id_cat WHERE id_ingredient = :id_prem AND id_super_categ = :id_cat_prem ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id_ingredient);
			$query->bindValue(":id_cat_prem",$objetFinal->_id_super_categ);
			$query->bindValue(":id",$objetFinal->_id_ingredient);
			$query->bindValue(":id_cat",$objetFinal->_id_super_categ);
			$query->execute();
		}
	}

	public function all(){
			$req = "SELECT * FROM has_super_categ";
			$query->execute();
			$ret = [];
			foreach ($query->fetchAll() as $key => $value) {
				$ret[] = new Has_super_categ($value["id_ingredient"],$value["id_super_categ"]);
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
			echo $conditions;
			$req = "SELECT * FROM has_super_categ WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$retour[] = new Has_super_categ($value["id_ingredient"],$value["id_super_categ"]);
			}
			return $retour;
	}

}