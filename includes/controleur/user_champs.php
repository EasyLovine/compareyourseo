<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/Champ.php'));

if(!empty($_SESSION['id_client'])){
	$champs = Champ::getUserChamps($_SESSION['id_client']);
	include_once(realpath(dirname(__FILE__).'/../vues/user_champs.php'));
}
else
	header('Location: /');