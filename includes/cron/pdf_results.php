<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));
require_once(realpath(dirname(__FILE__).'/../modele/Champ.php'));
require_once(realpath(dirname(__FILE__).'/../utils/reports.php'));
require_once(realpath(dirname(__FILE__).'/../tcpdf/tcpdf.php'));
require_once(realpath(dirname(__FILE__).'/../tcpdf/config/tcpdf_config.php'));

function generateAllPDF(){
	$tasks = query('select t2.id_client, t1.id_site, t1.id_champ, t2.nom_site, t3.nom_champ from site_champ_semantique t1, site t2, champ_semantique t3 where t1.id_site = t2.id_site and t1.id_champ = t3.id_champ order by t2.id_client desc', array());
	foreach ($tasks as $key => $value) {
		generatePDF($value->id_client, $value->id_site, $value->id_champ, $value->nom_site, $value->nom_champ);
	}
}

function generatePDF($idClient, $id_site, $id_champ, $nomSite, $nomChamp){
	createDir($idClient);
	$dir = realpath(dirname(__FILE__).'/../../rapports/'.$idClient.'/');
	chdir($dir);
	$date = date('d-m-y');
	$results = calcul($id_site, $id_champ);
	if(!empty($results)){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Résultats champs sémantique : ' . $nomChamp);
		/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);*/
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();

		$html = "<style>".file_get_contents(realpath(dirname(__FILE__).'/style.css'))."</style>";
		$html .= "<h1>Champ sémantique ". $nomChamp."</h1>";
		$html .= '<h1> Site: '.$nomSite.' ' .$date. '</h1>';
		$html.= '<table class="results" cellspacing="0" cellpadding="10">';
		$html.='<tr class="coll"><td>Position</td><td>Site</td><td>Indice performance</td></tr>';
		$i=1;
		foreach ($results as $key => $value){
			if(empty($key))
				$key = "Champ Google";
			if(($i-1)%2==0)
				$html .='<tr class="row_odd"><td>'.$i++.'</td><td>'. $key .'</td><td>'.$value."%</td></tr>";
			else
				$html .='<tr class="row"><td>'.$i++.'</td><td>'. $key .'</td><td>'.$value."%</td></tr>";
		}
		$html.= "</table>";
		$pdf->writeHTML($html, true, false, true, false, '');
		$nomChamp = str_replace(array(' ', '_'), array(''), $nomChamp);
		$pdf->Output($id_champ.'_'.$nomChamp.'_'.$date.'.pdf', "F");
		if($idClient == 1)
			Champ::removeChamp($idClient, $id_champ);
	}
}

function calcul($id_site, $id_champ){
	$site = array();
	$valCtr = array();
	$tab = query('select t1.url, t1.position, t2.ponderation, t1.date from resultat t1, expression t2 where t1.date = (select max(date) from resultat where id_champ = ? and id_site = ?) and t1.id_champ = ? and t1.id_site = ? and t2.id_expression = t1.id_expression', array($id_champ, $id_site, $id_champ, $id_site));
	$ctr = query('select position, value from ctr where id_champ = ?', array($id_champ));
	if(empty($ctr)){
		$ctr = query('select position, value from ctr where id_champ is null', array());
	}

	foreach ($ctr as $val) {
		$valCtr[$val->position] = $val->value; 
	}

	$exps = query('SELECT id_expression, ponderation FROM expression WHERE id_champ = ?', array($id_champ));
	$ref = 0;

	foreach ($exps as $value) {
		$ref += $value->ponderation*$valCtr[1];
	}

	foreach ($tab as $val) {
		$site[$val->url] += $val->ponderation*$valCtr[$val->position];
	}

	foreach ($site as $key => $value) {
		$site[$key] = round(($site[$key]/$ref)*100);
	}
	arsort($site);
	return $site;
}

generateAllPDF();
