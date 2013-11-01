<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/Champ.php'));
require_once(realpath(dirname(__FILE__).'/../modele/Expression.php'));

if(!empty($_SESSION['id_client'])){
	if(!empty($_GET['arg']))
		$keywords = Expression::getUserChampExpressions($_SESSION['id_client'], $_GET['arg']);
	else
		$keywords = array();
	$champs = Champ::getUserChamps($_SESSION['id_client']);
	include_once(realpath(dirname(__FILE__).'/../vues/user_keywords.php'));
}
else
	header('Location: /');