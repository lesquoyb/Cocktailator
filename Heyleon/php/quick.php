<?php 
// Author :
// GALLO Mathieu
// mattewphoenyx@hotmail.fr

// Return true and set the value in $var if the session exists or set $default in $var
function isSession($id, &$var='', $default=null)  {
	if (isset($_SESSION[$id])) {
		$var = $_SESSION[$id];
		return true;
	} else {
		$var = $default;
		return false;
	}
}

// Return true and set the value in $var if the get exists or set $default in $var
function isGet($id, &$var, $default=null) {
	if (isset($_GET[$id])) {
		$var = $_GET[$id];
		return true;
	} else {
		$var = $default;
		return false;
	}
}

// Return true and set the value in $var if the post exists or set $default in $var
function isPost($id, &$var, $default=null) {
	if (isset($_POST[$id])) {
		$var = $_POST[$id];
		return true;
	} else {
		$var = $default;
		return false;
	}
}

// Write JS script with PHP
function script($str) { echo '<script>'.trim($str).'</script>'; }

// Show a dialog with your string
function see($str) { script('alert("'.$str.'");'); }

?>