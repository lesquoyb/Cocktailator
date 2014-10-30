<?php

class Cocktail{
	
	public $_id;
	public $_cocktail_name;
	public $_cocktail_require;
	public $_cocktail_step;

	public function __construct($id,$name,$require,$step){
		$this->_id = $id;
		$this->_cocktail_name = $name;
		$this->_cocktail_require = $require;
		$this->_cocktail_step = $step;
	}
	
	public function resume() {
		echo "<div class='cocktail_resume'><img src='/Cocktailator/data/Photos/Black_velvet.jpg' />".$this->_cocktail_name."</div>";
	}
}