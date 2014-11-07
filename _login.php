<?php 
include("php/functions.php");
require_once("classes/userManager.class.php");

$err = '';

if (isPost('pseudo', $pseudo) && isPost('password', $password)) {
	$dataBase = connect();
	$user_manager = new userManager($dataBase);
	
	$query = $dataBase->prepare("SELECT id_user FROM user WHERE user_name = ?");
	$query->execute(array($pseudo));
	if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
		$query = $dataBase->prepare("SELECT id_user FROM user WHERE user_name = ? AND user_password = ?");
		$query->execute(array($pseudo, md5($password)));
		if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
			$favorite = array();
			$query = $dataBase->query("SELECT id_cocktail FROM has_favorite_cocktail WHERE id_user = ".$id);
			while (list($id_cocktail) = $query->fetch(PDO::FETCH_NUM)) $favorite[] = $id_cocktail;
			if (isset($_SESSION['favorite'])) {
				$old_favorite = unserialize($_SESSION['favorite']);
				var_dump($old_favorite);
				var_dump($favorite);
				foreach($old_favorite as $old) {
					if (!in_array($old, $favorite)) {
						$favorite[] = $old;
						$user_manager->addFavorite($id, $old);
						see($old);
					}
				}
			}
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['id'] = $id;
			$_SESSION['favorite'] = serialize($favorite);
		} else $err = 'password';
	} else $err = 'login';

	if ($err !== '') {
		$err = '?error='.$err;
		header("Location: /Cocktailator/iindex.php".$err);
	} else header("Location: /Cocktailator/");
	
} else header("Location: /Cocktailator/iindex.php".$err);

?>