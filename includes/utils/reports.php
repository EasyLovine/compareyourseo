<?php

function createDir($idClient = ""){
	if(!empty($_SESSION['id_client']))
		$id = $_SESSION['id_client'];
	else
		$id = $idClient;

	if(!empty($id)){
		$reportsDir = realpath(dirname(__FILE__).'/../../rapports');
		$dir = $reportsDir.'/'.$id;
		if(!is_dir($dir))
			mkdir($dir);
	}
	clearstatcache();
}

function listClientReports(){
	if(!empty($_SESSION["id_client"])){
		$dir = realpath(dirname(__FILE__).'/../../rapports/'.$_SESSION["id_client"].'/');
		$scan = scandir($dir);
		$reports = array();
		foreach ($scan as $file){
			if($file != "." && $file != "..")
				$reports[$file] = filemtime($dir . '/' . $file);
		}
		arsort($reports);
		return $reports; 
	}
}

function remFiles($dir){
	$dir = realpath(dirname(__FILE__).'/../../rapports/'.$dir);
	$scan = scandir($dir);
	foreach ($scan as $file){
		if($file != "." && $file != "..")
			unlink($dir . '/' . $file);
	}
	rmdir($dir);
}
