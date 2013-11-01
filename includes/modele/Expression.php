<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class Expression{
	
	public static function newExpression($expression, $ordre, $ponderation, $idChamp, $idClient){
		$args = func_get_args();
		query('Insert into expression(contenu_expression, num_ordre, ponderation, id_champ, id_client) values(?,?,?,?,?)', $args);
	}

	public static function updateExpression($expression, $ordre, $ponderation, $idExpression, $idClient){
		$args = func_get_args();
		query('Update expression set contenu_expression = ?, num_ordre = ?, ponderation = ? where id_expression = ? and id_client = ? ', $args);
	}
	
	public static function removeExpression($idExp, $idClient){
		$args = func_get_args();
		query('delete from expression where id_expression = ? and id_client = ? ', $args);
	}

	public static function getUserChampExpressions($id_client, $id_champ){
		$args = func_get_args();
		return query('select id_expression, contenu_expression, num_ordre, ponderation from expression where id_client = ? and id_champ = ? order by id_expression desc', $args);
	}

}