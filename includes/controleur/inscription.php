<?php
session_start();
require_once(realpath(dirname(__FILE__).'/../modele/User.php'));

if(($_GET["inscription"] == "freeware" || $_GET['inscription'] =="premium") && empty($_SESSION['id_client'])){
	$registered = false;
	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdp1']) && !empty($_POST['mdp2']) && $_POST['mdp1'] == $_POST['mdp2'] 
		&& strlen($_POST['mdp1']) > 6 && !empty($_POST['phone']) && !empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
		$registered = true;
		$salt = uniqid(mt_rand(), true);
		$idVerif = uniqid(mt_rand(), true);
		$hash = crypt($_POST['mdp1'], $salt);
		User::newUser($_POST['nom'], $_POST['prenom'], "", $_POST['mail'], $hash, $salt, $idVerif, $_POST['phone']);
		mail($_POST['mail'], "Validation de votre compte Compareyourseo", 'Bonjour
Cliquez sur ce lien afin de valider votre compte : http://www.compareyourseo.net/validation/'.$_POST['mail'].'/'.$idVerif);
	}
	include_once(realpath(dirname(__FILE__).'/../vues/inscription.php'));
}
else
	header('Location: /');