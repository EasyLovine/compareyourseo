<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/Site.php'));

if(!empty($_SESSION['id_client'])){
	$sites = Site::getUserSites($_SESSION['id_client']);
	include_once(realpath(dirname(__FILE__).'/../vues/user_sites.php'));
}
else
	header('Location: /');