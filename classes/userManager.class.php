<?php
require_once 'user.class.php';
require_once 'DAO.interface.php';
require_once 'has_favorite_cocktailManager.class.php';
require_once 'cocktailManager.class.php';

class UserManager implements DAO{
	

	private $_db;

	public function __construct(PDO $db){
		$this->_db = $db;
	}


	/*
	* Insert un objet dans la bdd
	*/
	public function insert( $objet){
		if ($objet instanceof User){
			$req = "INSERT INTO user VALUES (:id,:name,:pass,:mail)";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->bindValue(":name",$objet->_user_name);
			$query->bindValue(":pass",$objet->_user_password);
			$query->bindValue(":mail",$objet->_user_mail);

			$query->execute();
		}

	}


	/*
	* supprime un objet dans la bdd
	*/
	public function delete( $objet){
		if ($objet instanceof User){
			$req = "DELETE FROM user WHERE id_user = :id";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id",$objet->_id);
			$query->execute();
		}
	}


	/*
	* modifie un objet dans la bdd
	*/
	public function update( $objetDepart, $objetFinal){
		if (($objetDepart instanceof User) and ( $objetFinal instanceof User)){
			$req = "UPDATE user SET id_user = :id, user_name = :name, user_password = :pass, user_mail = :mail WHERE id_user = :id_prem ";
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id);
			$query->bindValue(":id",$objetFinal->_id);
			$query->bindValue(":name",$objetFinal->_user_name);
			$query->bindValue(":pass",$objetFinal->_user_password);
			$query->bindValue(":mail",$objetFinal->_user_mail);
			$query->execute();
		}
	}


	/*
	* renvoie tous les objet de la table
	*/
	public function all(){
		$req = "SELECT * FROM user";
		$query = $this->_db->prepare($req);
		$query->execute();
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$favorite_cocktails = array();
			$sub_query = $this->_db->query("SELECT id_cocktail FROM has_favorite_cocktail WHERE id_user = ".$value["id_user"]);
			while (list($id_cocktail) = $sub_query->fetch(PDO::FETCH_NUM)) {
				$favorite_cocktails[] = $id_cocktail;
			}
			$ret[] = new User($value["id_user"],$value["user_name"],$value["user_password"],$value["user_mail"], $favorite_cocktails);
		}
		return $ret;
	}

	/*
	* Renvoie l'id correspondant au nom passé en paramètre
	*/
	public function getIdByName($name){
		$req = "SELECT id_user FROM user WHERE user_name = :name";
		$query = $this->_db->prepare($req);
		$query->bindValue(":name",$name);
		$query->execute();
		$res = $query->fetch();
		return $res["id_user"];
	}
	
	public function getById($id) {
		$req = "SELECT * FROM user WHERE id_user = :id_user";
		$query = $this->_db->prepare($req);
		$query->bindValue(':id_user', $id);
		$query->execute();
		$ret = [];
		foreach ($query->fetchAll() as $key => $value) {
			$favorite_cocktails = array();
			$sub_query = $this->_db->query("SELECT id_cocktail FROM has_favorite_cocktail WHERE id_user = ".$id);
			while (list($id_cocktail) = $sub_query->fetch(PDO::FETCH_NUM)) {
				$favorite_cocktails[] = $id_cocktail;
			}
			$ret[] = new User($value["id_user"],$value["user_login"], $value["user_name"], $value["user_password"], $value["user_mail"], $value["user_firstname"], $value["user_sex"], $value["user_birthday"], $value["user_address"], $value["user_post_code"], $value["user_town"], $value["user_phone_num"], $favorite_cocktails);
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
			$req = "SELECT * FROM user WHERE " . $conditions;
			$query = $this->_db->prepare($req);
			foreach($criteres as $key => $value){
				$query->bindValue(":$key",$value);
			}
			$query->execute();
			foreach ($query->fetchAll() as $key => $value) {
				$favorite_cocktails = array();
				$sub_query = $this->_db->query("SELECT id_cocktail FROM has_favorite_cocktail WHERE id_user = ".$value["id_user"]);
				while (list($id_cocktail) = $sub_query->fetch(PDO::FETCH_NUM)) {
					$favorite_cocktails[] = $id_cocktail;
				}
				$retour[] = new User($value["id_user"],$value["user_name"],$value["user_password"],$value["user_mail"], $favorite_cocktails);
			}
			return $retour;
	}
	
	public function addFavorite($id_user, $id_cocktail) {
		$req = "INSERT INTO has_favorite_cocktail VALUES (".$id_user.", ".$id_cocktail.")";
		$query = $this->_db->prepare($req);
		//$query->bindValue(":id_user",$id_user);
		//$query->bindValue(":id_cocktail",$id_cocktail);
		$query->execute();
	}
	
	public function removeFavorite($id_user, $id_cocktail) {
		$req = "DELETE FROM has_favorite_cocktail WHERE id_user = :id_user AND id_cocktail = :id_cocktail";
		$query = $this->_db->prepare($req);
		$query->bindValue(":id_user",$id_user);
		$query->bindValue(":id_cocktail",$id_cocktail);
		$query->execute();
	}

	/*
	* Renvoie les cocktails favori de l'utilisateur passé en param
	*/
	public function favorite_cocktails($user){
		$ret = array();
		$fav_man = new Has_favorite_cocktailManager($this->_db);
		$cock_man = new CocktailManager($this->_db);
		$has_fav = $fav_man->selectWhere(array('id_user' => $user->_id));
		foreach ($has_fav as $key => $value) {
			$ret[] = $cock_man->selectWhere(array('id_cocktail' => $value->_id_cocktail))[0];
		}
		return $ret;
	}

}