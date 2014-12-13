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
		if (isSession('favorite', $favoris)) $favoris = unserialize($favoris);
		else $favoris = array();
		foreach ($this->_ingredients_name as $ingredient) {
			$ing .= "<li>".$ingredient."</li>";
		}
		if (in_array($this->_id, $favoris)) {
			$favorite = " class='front favorite' ";
			$span = "<span class='glyphicon glyphicon-star'></span>";
		} else {
			$favorite = " class='front' ";
			$span = "";
		}
		$dir = explode('Cocktailator', dirname(__FILE__));
		$dir = $dir[0].'Cocktailator/';
		if (file_exists($dir."/data/Photos/".getPictureNameFor($this->_cocktail_name)) ) $url_picture = getPictureFor($this->_cocktail_name);
		else $url_picture = "/Cocktailator/Graphics/empty_cocktail.jpg";
		echo 
		"<div class='cocktail_resume'>
			<div class='hover panel'>
				<div ".$favorite." class='front'>
					<div><img src='".$url_picture."' /></div>
					<h5 style='height:25px;'>".$span." ".$this->_cocktail_name."</h5>
				</div>
				<div class='back'>
					<h4>Ingrédients :</h4>
					<div><ul>".$ing."</ul></div>
					<a onclick=\"$('.middle_container').load('/Cocktailator/cocktail.php', { id_cocktail: ".$this->_id." })\">Détailler ce cocktail</a>
				</div>
			</div>
		</div>
		<script>		$('.hover').hover(function(){
			$(this).addClass('flip');
		},function(){
			$(this).removeClass('flip');
		});</script>";
	}
	
	public function toHtml() {
		$ingredients_list = explode('|', $this->_cocktail_require);
		$ing = "";
		foreach ($ingredients_list as $ingredients) {
			$ing .= "<li>".$ingredients."</li>";
		}
		$favoris = unserialize($_SESSION['favorite']);
		if (in_array($this->_id, $favoris)) $fav_span = "<span class='good'> <span class='glyphicon glyphicon-star'></span> Favori </span>";
		else $fav_span = "<span> <span class='glyphicon glyphicon-star-empty'></span> Favori </span>";
		require_once "cocktailManager.class.php";
		require_once dirname(__FILE__) . "/../php/functions.php";
		$cMan = new CocktailManager(connect());
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
				<div class='commentaires'>
					" . $cMan->commentaires($this) . "
				</div>
				<script>
					$('.cocktail > span').click(function () {
						if ($('.cocktail > span').hasClass('good')) {
							$.post('/Cocktailator/_cocktail/remove_favorite.php', {id_cocktail : ".$this->_id."} );
							$('.cocktail > span').removeClass('good');
							$('.cocktail > span > span').addClass('glyphicon-star-empty').removeClass('glyphicon-star');
						} else {
							$.post('/Cocktailator/_cocktail/add_favorite.php', { id_cocktail : ".$this->_id."} );
							$('.cocktail > span').addClass('good');
							$('.cocktail > span > span').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
						}
					});
				</script>";
	}
}
