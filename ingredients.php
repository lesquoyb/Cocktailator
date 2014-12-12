<?php
require_once("php/functions.php");
require_once("classes/IngredientManager.class.php");


isPost("id_ing", $id_ing, 6);

$iman = new IngredientManager(connect());
$ing = $iman->all();
//var_dump($ing);
$iman->toHtml($ing, $id_ing);


?>

<script type="text/javascript">
	$("ul.sous_menus").hide();
	$('li.titre_menu > a').click(function(){    

		if( $(this).has('ul') ) {
			alert($(this).attr("id_ing"));
			$(this).nextAll().slideToggle();
		}
	return false;
    });
</script>