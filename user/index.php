<?php
	require_once '../php/functions.php';
	onlyRegistered();
	require_once '../classes/userManager.class.php';
	$man = new UserManager(connect());
	$user = $man->selectWhere(array('id_user' => $_SESSION['id']))[0];
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include '../links.html'; ?>
		<title><?= $user->_user_name ?>: espace perso</title>	
	</head>
	<body>
		

		<div class="middle_container">
			<?php include 'favoris.php'; ?>
		</div>

	</body>
</html>