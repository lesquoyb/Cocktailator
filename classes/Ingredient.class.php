<?php

class Ingredient {

	public $_name;
	public $_id;
	public $_racine;
	public $_enfants;

	public function __construct($id,$name,$racine,$enfants){
		$this->_name = $name;
		$this->_id = $id;
		$this->_racine = $racine;
		$this->_enfants = $enfants;
	}

	
	public function getChildren(){
		return $this->_enfants;
	}



	public static function dessinerEnfants(Ingredient $arbre){
		echo " <ul class='" . ( ($arbre->_racine) ? "racine" : "sous_menus" ) . " '>";
		if ($arbre->_enfants != NULL){
			foreach ($arbre->_enfants as $key => $value) {
				echo "<li class='titre_menu'><a href='#'/>";
				echo $value->_name;
				Ingredient::dessinerEnfants($value);
				echo "</li>";
			}
		}
		echo "</ul>";

	}

	public function toHTML(){
		?>
			<div class="ingredient">
				<h4><?= $this->_name;?> </h4>
				<div class="enfants">
					<?php Ingredient::dessinerEnfants($this); ?>
				</div>

			</div>
		<?php
	}

}