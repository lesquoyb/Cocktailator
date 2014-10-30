<?php
require_once 'userManager.class.php';
require_once '../php/functions.php';

$man = new UserManager(connect());


$man->update(new User(156,'raoul','oijopj','imjoi'),new User(10,'raoul duke','royksoup','blabla'));