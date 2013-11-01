<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/Site.php'));
require_once(realpath(dirname(__FILE__).'/../modele/Champ.php'));

if(!empty($_SESSION['id_client'])){
	$sites = Site::getUserSites($_SESSION['id_client']);
	if(!empty($_GET['arg']))
		$champs = Champ::getSiteChamps($_SESSION['id_client'], $_GET['arg']);
	else
		$champs = array();
	include_once(realpath(dirname(__FILE__).'/../vues/user_gestionSite.php'));
}
else
	header('Location: /');