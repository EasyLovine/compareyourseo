<?php
if (!empty($_GET['section'])){
	if($_GET['section'] == 'connexion')
		include_once('includes/controleur/connexion.php');
	else
    	header('Location: /');
}
else if(!empty($_GET['user'])){
	if($_GET['user']=='home')
		include_once('includes/controleur/user_home.php');
	else if($_GET['user']=='sites')
		include_once('includes/controleur/user_sites.php');
	else if($_GET['user']=='champs')
		include_once('includes/controleur/user_champs.php');
	else if($_GET['user']=='keywords')
		include_once('includes/controleur/user_keywords.php');
	else if($_GET['user']=='gestion')
		include_once('includes/controleur/user_gestionSite.php');
	else
		header('Location: /');
}
else if(!empty($_GET['inscription']))
	include_once('includes/controleur/inscription.php');
else if(!empty($_GET['validation']) && filter_var($_GET['validation'], FILTER_VALIDATE_EMAIL))
	include_once('includes/controleur/validation.php');
else
    include_once('includes/vues/index.php');
