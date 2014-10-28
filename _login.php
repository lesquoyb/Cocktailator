<?php 
include("php/functions.php");

$err = '';
$dataBase = connect();
$pseudo = strToData($_POST['pseudo']);
$password = md5(strToData($_POST['password']));
$query = $dataBase->prepare("SELECT id_player FROM player WHERE pl_name = ?");
$query->execute(array($pseudo));

if (list($id) = $query->fetch(PDO::FETCH_NUM)) {
	$query = $dataBase->prepare("SELECT id_player FROM player WHERE pl_name = ? AND pl_password = ?");
	$query->execute(array($pseudo, $password));
	if (list($id, $id_alliance) = $query->fetch(PDO::FETCH_NUM)) {
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['id'] = $id;
		$query = $dataBase->query("SELECT id_alliance FROM has_alliance WHERE id_player = ".$_SESSION['id']);
		list( $_SESSION['alliance'] ) = $query->fetch(PDO::FETCH_NUM);
		$_SESSION[ 'buildings' ] = serialize(new Buildings());
		$_SESSION[ 'sciences' ] = serialize(new Sciences());
		$_SESSION[ 'units' ] = serialize(new Units());
	} else $err = 'password';
	
} else $err = 'login';

if ($err != '') {
	$err = '?error='.$err;
	header("Location: ".$url_begin.$err);
} else {
	header("Location: ".$url_begin."/general.php");

}
?>