<?php
require_once '../php/functions.php';
onlyRegistered();
?>
<!DOCTYPE html>
<html>
	<head>

		<?php include '../links.html'; ?>
		<title><?= $_SESSION["pseudo"]?>: espace perso</title>	</head>


	<body>
		<?php include("../menu.php"); ?>
		<div class="middle_container">
			
		</div>

	</body>
</html>