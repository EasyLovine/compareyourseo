<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/User.php'));
require_once(realpath(dirname(__FILE__).'/../utils/reports.php'));

if(empty($_SESSION['id_client'])){
	$displayError = false;
	if(!empty($_POST['email']) && !empty($_POST['pw'])){
		$tab = User::getPW($_POST['email']);
		if(!empty($tab)){
			$pw = $tab[0]->mdp;
			$id = $tab[0]->id_client;
			$salt = $tab[0]->salt;
			if(crypt($_POST['pw'], $salt) == $pw){
				$_SESSION['id_client'] = $id;
				createDir();
				header('Location: /user/home');
			}
			else
				$displayError = true;
		}
		else
			$displayError = true;
	}
	include(realpath(dirname(__FILE__).'/../vues/connexion.php'));
}
else
	header('Location: /user/home');