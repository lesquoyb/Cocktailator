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
		echo 
		"<div class='cocktail_resume'>
			<div class='flip-card'><div class='flip'>
				<div>
					<div><img src='".getPictureFor($this->_cocktail_name)."' /></div>
					<h5 style='height:25px;'>".$this->_cocktail_name."</h5>
				</div>
				<div>test</div>
			</div></div>
		</div>";
	}
}