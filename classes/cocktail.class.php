<?php

class Cocktail{
	
	public $_id;
	public $_cocktail_name;
	public $_cocktail_require;
	public $_cocktail_step;
	public $_ingredients_name;

	public function __construct($id,$name,$require,$step, $ingredients_name){
		$this->_id = $id;
		$this->_cocktail_name = $name;
		$this->_cocktail_require = $require;
		$this->_cocktail_step = $step;
		$this->_ingredients_name = $ingredients_name;
	}
	
	public function resume() {
		foreach ($this->_ingredients_name as $ingredient) {
			$ing .= "<li>".$ingredient."</li>";
		}
		echo 
		"<div class='cocktail_resume'>
			<div class='flip-card'><div class='flip'>
				<div>
					<div><img src='".getPictureFor($this->_cocktail_name)."' /></div>
					<h5 style='height:25px;'>".$this->_cocktail_name."</h5>
				</div>
				<div>
					<h4>Ingrédients :</h4>
					<div><ul>".$ing."</ul></div>
					<a href='#'>Détailler ce cocktail</a>
				</div>
			</div></div>
		</div>";
	}
	
	public function toHtml() {
		echo 
		"<div class='cocktail'>
			<img src='".getPictureFor($this->_cocktail_name)."' />
			<div>
				<h3>".$this->_cocktail_name."</h3>
			</div>
			".str_replace('|', ' • ', $this->_cocktail_require)."
			
		</div>";
	}
}