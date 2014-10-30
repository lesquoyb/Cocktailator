<?php
require_once("php/functions.php");
require_once("classes/cocktailManager.class.php");

$dataBase = connect();
$cocktail_manager = new cocktailManager($dataBase);
$cocktails = $cocktail_manager->all();



see(nettoyerChaine("é'- è"));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="Cocktailator, tout simplement">
	<meta name="description" content="Recettes de cocktails en ligne">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Amaranth">
	<link type="image/png" href="Graphics/icon.png" rel="icon">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link href="Heyleon/css/heyleon.css" rel="stylesheet">
	<link href="css/general.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script async src="js/functions.js"></script>
	<script async src="js/bootstrap.min.js "></script>
	<script async src="js/md5.js"></script>
	<title>Cocktailator</title>
	<meta name="keywords" content="cocktail, ator">
	<meta name="robots" content="index, nofollow" >
</head>

</body>

<div class="middle_container">
	<?php
	$random_cocktails = [];
	while (count($random_cocktails) != 4) {
		$rand = rand(0, count($cocktails));
		if (!in_array($rand, $random_cocktails)) $random_cocktails[] = $rand;
	}
	foreach ($random_cocktails as $key) $cocktails[$key]->resume();

	?>
</div>
<?php include("menu.php"); ?>

</body>
</html>