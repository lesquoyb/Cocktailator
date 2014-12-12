<?php

class Ingredient {

	public $_name;
	public $_id;
	public $_racine;
	public $_enfants;
	public $_parents;

	public function __construct($id,$name,$racine,$enfants){
		$this->_name = $name;
		$this->_id = $id;
		$this->_racine = $racine;
		$this->_enfants = $enfants;
	}

	
	public function getChildren(){
		return $this->_enfants;
	}

	
	public function getLowerElement($all) {
		$res = array();
		if (count($this->_enfants) != 0) {
			// Big recursive
			for ($i = 0; $i < count($this->_enfants); $i ++) {
				foreach ($all[$this->_enfants[$i]]->getLowerElement($all) as $lower_elements) $res[$lower_elements] = $lower_elements;
			}
			return $res;
		} else return array($this->_id);
	}


	public static function dessinerEnfants(Ingredient $arbre){
		echo " <ul class='" . ( ($arbre->_racine) ? "racine" : "sous_menus" ) . " '>";
		if ($arbre->_enfants != NULL){
			foreach ($arbre->_enfants as $key => $value) {
				echo "<li class='titre_menu' ><a href='#' id_ing='".$value->_id."'>";
				echo $value->_name;
				echo "</a>";
				Ingredient::dessinerEnfants($value);
				echo "</li>";
			}
		}
		echo "</ul>";

	}

	public function toHTML(){
		?>
			<div class="ingredient">
				<h4 id_ing="<?= $this->_id;?>" ><?= $this->_name;?> </h4>
				<div class="enfants">
					<?php Ingredient::dessinerEnfants($this); ?>
				</div>

			</div>
		<?php
	}
	


}