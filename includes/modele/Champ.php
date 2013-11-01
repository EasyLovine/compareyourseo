<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class Champ{

	public static function newChamp($nomChamp, $ordre, $idClient){
		$args = func_get_args();
		array_push($args, date('d', time()));
		return query('Insert into champ_semantique(nom_champ, num_ordre, id_client, jour_rafraichissement) values(?,?,?,?)', $args);
	}

	public static function updateChamp($nomChamp, $ordre, $idClient, $id_champ){
		$args = func_get_args();
		query('Update champ_semantique set nom_champ = ?, num_ordre = ? where id_client = ? and id_champ = ?', $args);
	}

	public static function removeChamp($idClient, $id_champ){
		$args = func_get_args();
		query('delete from resultat where id_champ = ? and exists(select id_champ from champ_semantique where id_client = ? and id_champ = ?)', 
			array($id_champ, $idClient, $id_champ));
		query('delete from site_champ_semantique where id_champ = ? and exists(select id_champ from champ_semantique where id_client = ? and id_champ = ?)', 
			array($id_champ, $idClient, $id_champ));
		query('delete from champ_semantique where id_client = ? and id_champ = ?', $args);
		query('delete from expression where id_client = ? and id_champ = ?', $args);
	}

	public static function getUserChamps($id_client){
		$args = func_get_args();
		return query('select t1.id_champ, t1.nom_champ, (select count(*) from expression where id_champ = t1.id_champ) as nbExp from champ_semantique t1 
			where t1.id_client = ? order by t1.id_champ desc', $args);
	}

	public static function getSiteChamps($idClient, $id_site){
		$args = func_get_args();
		return query('select t1.id_champ, t1.nom_champ, t1.num_ordre, (select count(*) from expression where id_champ = t1.id_champ) as nbExp 
					from champ_semantique t1, site_champ_semantique t2 where t1.id_champ = t2.id_champ and t1.id_client = ? and t2.id_site = ?', $args);
	}
	
	public static function delSiteChamp($idSite, $idChamp, $idClient){
		$args = func_get_args();
		query("delete t1.* from site_champ_semantique t1 where t1.id_site = ? and t1.id_champ = ? and t1.id_site in (select id_site from site where id_client = ? and id_site = ? )",
		array($idSite, $idChamp, $idClient, $idSite));
	}

	public static function addSiteChamp($idSite, $idChamp, $idClient){
		query("insert into site_champ_semantique(id_site, id_champ) select ?, ? from dual where exists (select id_site from site where id_client= ? and id_site = ? )", 
			array($idSite, $idChamp, $idClient, $idSite));
	}
	/*
	Récuperer les champs non assignés à un site web.
	*/
	public static function getNotAssignedSiteChamps($id_client, $id_site){
		$args = array($id_site, $id_client);
		return query("SELECT t1.id_champ, t1.nom_champ FROM champ_semantique t1 LEFT JOIN site_champ_semantique t2 ON t1.id_champ = t2.id_champ and t2.id_site = ? 
		where t2.id_site is null and t1.id_client = ?", $args);
	}
}
