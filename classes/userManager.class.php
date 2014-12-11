<?php
require_once 'user.class.php';
require_once 'DAO.interface.php';
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
			$req = "INSERT INTO user VALUES ( $objet->_id , $objet->_user_login ,$objet->_user_password, $objet->_user_name, 
											$objet->_user_mail,$objet->_user_firstname,$objet->_user_sex,,$objet->_user_birthday,
											$objet->_user_address,$objet->_user_post_code,$objet->_user_town,$objet->_user_phone_num)";
			$query = $this->_db->prepare($req);
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
			delete($objetDepart);
			insert($objetFinal);
			/*
			$req = "UPDATE user SET id_user = $objetFinal->_id ,user_login = $objetFinal->login ,user_password = $objetFinal->_user_password, user_name = $objetFinal->_user_name, 
											 user_mail = $objetFinal->_user_mail, user_firstname = $objetFinal->_user_firstname, user_sex = $objetFinal->_user_sex, user_birthday = $objetFinal->_user_birthday,
											 user_address = $objetFinal->_user_address , user_post_code = $objetFinal->_user_post_code , user_town = $objetFinal->_user_town , user_phone_num = $objetFinal->_user_phone_num WHERE id_user = :id_prem ";
			
			$query = $this->_db->prepare($req);
			$query->bindValue(":id_prem",$objetDepart->_id);
			$query->execute();
			*/
		}
	}
	
	public function updateLogin( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_login = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_login);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updatePassword( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_password = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_password);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateName( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_name = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_name);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateFirstname( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_firstname = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_firstname);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateMail( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_mail = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_mail);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateBirthday( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_birthday = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_birthday);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateAddress( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_address = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_address);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateCP( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_post_code = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_post_code);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateTown( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_town = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_town);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updatePhoneNum( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_phone_num = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_phone_num);
		$query->bindValue(":id",$user->_id);
		$query->execute();
	}
	public function updateSex( $user) {
		$query = $this->_db->prepare("UPDATE user SET user_sex = :val WHERE id_user = :id");
		$query->bindValue(":val",$user->_user_sex);
		$query->bindValue(":id",$user->_id);
		$query->execute();
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
			$ret[] = new User($value["id_user"],$value["user_login"], $value["user_password"], $value["user_name"],$value["user_mail"],$value["user_firstname"],
							  $value["user_sex"], $value["user_birthday"], $value["user_address"], $value["user_post_code"], $value["user_town"], $value["user_phone_num"] );
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
		$value = $query->fetchAll()[0];
		return  new User($value["id_user"],$value["user_login"], $value["user_password"], $value["user_name"],$value["user_mail"],$value["user_firstname"],
						  $value["user_sex"], $value["user_birthday"], $value["user_address"], $value["user_post_code"], $value["user_town"], $value["user_phone_num"] );
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
				$retour[] =new User($value["id_user"],$value["user_login"], $value["user_password"], $value["user_name"],$value["user_mail"],$value["user_firstname"],
						 		    $value["user_sex"], $value["user_birthday"], $value["user_address"], $value["user_post_code"], $value["user_town"], $value["user_phone_num"] );
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
		$req = "SELECT * FROM has_favorite_cocktail h,cocktail c WHERE id_user =  $user->_id AND h.id_cocktail = c.id_cocktail" ;// has_favorite_cocktail VALUES (".$id_user.", ".$id_cocktail.")";
		$query = $this->_db->prepare($req);
		$query->execute();
		foreach ($query->fetchAll() as $key => $value) {
			$ing = [];
			$sub_query = $this->_db->prepare("SELECT id_ingredient, ing_name FROM ingredient i, has_ingredient h WHERE h.id_ingredient = i.id_ingredient AND id_cocktail = ".$value["id_cocktail"] );
			$sub_query->execute();
			foreach ($sub_query->fetchAll() as $skey => $svalue) {
				$ing[] = new Ingredient($svalue["id_ingredient"], $svalue["ing_name"]);
			}
			$ret[] =new Cocktail($value["id_cocktail"],$value["cocktail_name"],$value["cocktail_require"],$value["cocktail_step"],$ing);
		}
		return $ret;
	}

}