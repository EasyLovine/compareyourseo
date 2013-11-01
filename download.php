<?php
session_start();

function downloadPDF($file){
	if(file_exists($file)){
		header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
		ob_clean();
	    flush();
	    readfile($file);
	    exit;
	}
	else
		header('Location: /');
}

if(!empty($_SESSION['id_client']) && !empty($_GET['file'])){
	$file = realpath(dirname(__FILE__).'/rapports/'.$_SESSION['id_client'].'/'.$_GET['file']);
	downloadPDF($file);
}
else
	header('Location: /');
