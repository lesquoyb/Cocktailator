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
		
		<title><?= $user->_user_name ?>: espace perso</title>
		<link rel="stylesheet" type="text/css" href="user.css">	
	</head>
	<body>
		

		<div class="">
			<?php include 'favoris.php'; 
				echo $user->_user_name;
				var_dump($user);
			?>

		</div>

	</body>
	<script type="text/javascript" src="_user.js"></script>
	<script type="text/javascript">
		toggle();
	</script>
</html>
