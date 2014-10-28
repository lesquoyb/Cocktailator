<?php
include("php/functions.php");
$_SESSION = array();
session_destroy();
header("Location: ".$url_begin);
?>