<?php
session_start();
require_once(realpath(dirname(__FILE__).'/includes/modele/Champ.php'));
require_once(realpath(dirname(__FILE__).'/includes/modele/Expression.php'));
require_once(realpath(dirname(__FILE__).'/includes/modele/Site.php'));

	if(!empty($_SESSION['id_client']) && !empty($_POST['action'])){
		$status = array("status"=> "ok");
		if($_POST['action'] == "addChamp" && !empty($_POST['name'])){
			Champ::newChamp($_POST['name'], "", $_SESSION['id_client']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "editChamp" && !empty($_POST['name']) && !empty($_POST['id_champ'])){
			Champ::updateChamp($_POST['name'], "", $_SESSION['id_client'], $_POST['id_champ']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "delChamp" && !empty($_POST['id_champ'])){
			Champ::removeChamp($_SESSION['id_client'], $_POST['id_champ']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "addKeyword" && !empty($_POST['id_champ']) && !empty($_POST['name']) && !empty($_POST['pond'])){
			Expression::newExpression($_POST['name'], "", $_POST['pond'], $_POST['id_champ'], $_SESSION['id_client']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "editKeyword" && !empty($_POST['id_keyword']) && !empty($_POST['name']) && !empty($_POST['pond'])){
			Expression::updateExpression($_POST['name'], "", $_POST['pond'], $_POST['id_keyword'], $_SESSION['id_client']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "delKeyword" && !empty($_POST['id_keyword'])){
			Expression::removeExpression($_POST['id_keyword'], $_SESSION['id_client']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "addSite" && !empty($_POST['name']) && !empty($_POST['url'])){
			Site::newSite($_SESSION['id_client'], $_POST['name'], $_POST['url']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "editSite" && !empty($_POST['name']) && !empty($_POST['url']) && !empty($_POST['id_site'])){
			Site::updateSite($_POST['name'], $_POST['url'], $_SESSION['id_client'], $_POST['id_site']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "delSite" && !empty($_POST['id_site'])){
			Site::removeSite($_SESSION['id_client'], $_POST['id_site']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "delSiteChamp" && !empty($_POST['id_champ']) && !empty($_POST["id_site"])){
			Champ::delSiteChamp($_POST["id_site"], $_POST["id_champ"], $_SESSION['id_client']);
			echo json_encode($status);
		}
		else if($_POST['action'] == "getNotAssignedChamps" && !empty($_POST["id_site"])){
			echo json_encode(Champ::getNotAssignedSiteChamps($_SESSION['id_client'], $_POST["id_site"]));
		}
		else if($_POST["action"] == "addSiteChamp" && !empty($_POST['id_site']) && !empty($_POST["id_champ"])){
			champ::addSiteChamp($_POST['id_site'], $_POST["id_champ"], $_SESSION["id_client"]);
			echo json_encode($status);
		}
	}
?>