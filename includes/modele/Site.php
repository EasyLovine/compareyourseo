<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class Site{

	public static function newSite($idClient, $nom_site, $url){
		$args = func_get_args();
		query('Insert into site(id_client, nom_site, url) values(?,?,?)', $args);
	}

	public static function updateSite($nom_site,$url,$idClient,$id_site){
		$args = func_get_args();
		query('Update site set nom_site = ?, url = ? where id_client = ? and id_site = ? ', $args);
	}

	public static function removeSite($idClient,$id_site){
		$args = func_get_args();
		query('delete from site_champ_semantique where id_site = ? and exists(select id_site from site where id_client = ? and id_site = ?)', 
			array($id_site, $idClient, $id_site));
		query('delete from site where id_client = ? and id_site = ?', $args);
	}

	public static function getUserSites($id_client){
		$args = func_get_args();
		return query('select t1.id_site, t1.nom_site, t1.url, (select count(*) from site_champ_semantique where id_site = t1.id_site) as nbChamp 
			from site t1 where t1.id_client = ? order by t1.id_site desc', $args);
	}
}