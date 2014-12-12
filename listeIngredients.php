<?php 
	require_once 'php/functions.php';
	include 'classes/IngredientManager.class.php';


?>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="listeIngredients.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){   
    $("ul.sous_menus").hide();
    $('li.titre_menu > a').click(function(){    
                 
            if($(this).has('ul')) {
            $(this).nextAll().slideToggle();
        }
    return false;
    });
});
</script>


<h2>Naviguer dans les ingrédients:</h2>
<?php
	foreach(IngredientManager::getHierarchy(connect()) as $racine){
		$racine->toHTML();
	} 
?>