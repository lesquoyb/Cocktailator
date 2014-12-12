<?php
include_once 'Ingredient.class.php';
include_once 'DAO.interface.php';
include_once 'cocktailManager.class.php';
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
			$ret[$value["id_ingredient"]] = new Ingredient($value["id_ingredient"],$value["ing_name"], false, NULL);
			// Récupération des enfants
			$query2 = $this->_db->prepare("SELECT id_low_categ FROM has_low_categ WHERE id_ingredient = ".$value["id_ingredient"]);
			$query2->execute();
			$ret[$value["id_ingredient"]]->_enfants = array();
			while(list($id) = $query2->fetch(PDO::FETCH_NUM)) $ret[$value["id_ingredient"]]->_enfants[] = $id;
			// Récupération des parents
			$query2 = $this->_db->prepare("SELECT id_super_categ FROM has_super_categ WHERE id_ingredient = ".$value["id_ingredient"]);
			$query2->execute();
			$ret[$value["id_ingredient"]]->_parents = array();
			while(list($id) = $query2->fetch(PDO::FETCH_NUM)) $ret[$value["id_ingredient"]]->_parents[] = $id;
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



	public static function getHierarchy($db){
		$query = $db->prepare("SELECT * FROM ingredient");
		$query->execute();
		$hier = [];
		$ret = [];
		$var_js = "";
		foreach ($query->fetchAll() as $key => $value) {
			$hier[$value["id_ingredient"]] = new Ingredient($value["id_ingredient"],$value["ing_name"],true,NULL);
		}

		// On liste tous les enfants de chaque élément
		$query = $db->prepare("SELECT h.id_ingredient,h.id_super_categ,i.ing_name FROM has_super_categ h,ingredient i WHERE h.id_super_categ = i.id_ingredient");
		$query->execute();
		foreach ($query->fetchAll() as $key => $value) {
				$hier[$value["id_ingredient"]]->_racine = false; 
				$hier[$value["id_super_categ"]]->_enfants[] = &$hier[$value["id_ingredient"]];
		}

		// On cherche les racines
		foreach ($hier as $key => $value) {
			if($value->_racine === true){
				$ret[] = $value;
			}
		}
		
		
		//var_dump($ret[0]);
		return $ret;
	}

	public function drawHierarchy($all, $current_id) {
		$test = "";
		$ids = "";
		if (count($all[$current_id]->_parents[0]) != 0) $parent_id = $all[$current_id]->_parents[0];
		else $parent_id = -1;
		while ($parent_id != -1) {
			$test = $all[$parent_id]->_name.";".$test;
			$ids = $parent_id.";".$ids;
			if (count($all[$parent_id]->_parents[0]) != 0) $parent_id = $all[$parent_id]->_parents[0];
			else $parent_id = -1;
		}
		$test = explode(";", $test);
		$ids = explode(";", $ids);
		
		echo '<ol class="breadcrumb">';
		for ($i = 0; $i < count($test) -1; $i++) echo '<li><a onclick=\'$(".middle_container").load("/Cocktailator/ingredients.php", {id_ing : '.$ids[$i].'});\'>'.$test[$i].'</a></li>';
		echo '<li class="active">'.$all[$current_id]->_name.'</li></ol>';
	}

	public function getLowerIngredients($all, $current_id) {
		$res = array();
		return $all[$current_id]->getLowerElement($all);
	}
	
	public function toHtml($all, $current_id) {
		$this->drawHierarchy($all, $current_id);
		echo "Catégories filles : ";
		foreach($all[$current_id]->_enfants as $id_child) echo '<a onclick=\'$(".middle_container").load("/Cocktailator/ingredients.php", {id_ing : '.$id_child.'});\'>['.$all[$id_child]->_name.'] </a>';
		echo "<br/>";
		$cocMan = new cocktailManager($this->_db);
		$cocktails = $cocMan->allContainingIngredients($this->getLowerIngredients($all, $current_id));
		foreach ($cocktails as $cocktail) $cocktail->resume();
	}
}
