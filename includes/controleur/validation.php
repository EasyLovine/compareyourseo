<?php
require_once(realpath(dirname(__FILE__).'/../modele/User.php'));

if(!empty($_GET['verif'])){
	$verified = false;
	$verif = User::getVerif($_GET['verif'], $_GET["validation"]);
	if(!empty($verif)){
		User::setVerifNull($_GET["validation"]);
		$verified = true;
	}
	else
		header('Location: /');
}
include_once(realpath(dirname(__FILE__).'/../vues/validation.php'));
