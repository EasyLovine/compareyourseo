<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/Site.php'));
require_once(realpath(dirname(__FILE__).'/../utils/reports.php'));

if(!empty($_SESSION['id_client'])){
	$sites = Site::getUserSites($_SESSION['id_client']);
	$reports = listClientReports();
	include_once(realpath(dirname(__FILE__).'/../vues/user_home.php'));
}
else
	header('Location: /');