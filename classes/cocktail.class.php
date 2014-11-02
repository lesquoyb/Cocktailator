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
		$ing ="";
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
					<a onclick=\"$('.middle_container').load('/Cocktailator/cocktail.php', { id_cocktail: ".$this->_id." })\">Détailler ce cocktail</a>
				</div>
			</div></div>
		</div>";
	}
	
	public function toHtml() {
		$ingredients_list = explode('|', $this->_cocktail_require);
		foreach ($ingredients_list as $ingredients) {
			$ing .= "<li>".$ingredients."</li>";
		}
		$favoris = unserialize($_SESSION['favorite']);
		if (in_array($this->_id, $favoris)) $fav_span = "<span class='good'> <span class='glyphicon glyphicon-ok'></span> Favori </span>";
		else $fav_span = "<span> <span class='glyphicon glyphicon-plus'></span> Favori </span>";
		echo 
		"<div class='cocktail'>
			<img src='".getPictureFor($this->_cocktail_name)."' />
			".$fav_span."
			<div>
				<h2><span>".$this->_cocktail_name."</span></h2>
				<img src='/Cocktailator/Graphics/star.png' />
				<img src='/Cocktailator/Graphics/star.png' />
				<img src='/Cocktailator/Graphics/star.png' />
				<img src='/Cocktailator/Graphics/star.png' />
				<img src='/Cocktailator/Graphics/star.png' />
			</div><ul class='nav nav-pills nav-justified' role='tablist'>
				".$ing."
			</ul>
			<p>
				".$this->_cocktail_step."
			</p>
		</div>
		<script>
			$('.cocktail > span').click(function () {
				if ($('.cocktail > span').hasClass('good')) {
					$.post('/Cocktailator/_cocktail/remove_favorite.php', {id_cocktail : ".$this->_id."} );
					$('.cocktail > span').removeClass('good');
					$('.cocktail > span > span').addClass('glyphicon-plus').removeClass('glyphicon-ok');
				} else {
					$.post('/Cocktailator/_cocktail/add_favorite.php', { id_cocktail : ".$this->_id."} );
					$('.cocktail > span').addClass('good');
					$('.cocktail > span > span').removeClass('glyphicon-plus').addClass('glyphicon-ok');
				}
			});
		</script>";
	}
}
