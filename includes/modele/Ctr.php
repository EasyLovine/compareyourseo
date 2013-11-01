<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class Ctr
{
	public static function posValue($id_champ, $position, $val){
		$args = func_get_args();
		query('Insert into ctr(id_champ, position, value) values(?,?,?) on duplicate key update value=values(value)', $args)
	}

	public static function getPosValues($id_champ){
		$args = func_get_args();
		return quey('Select id_champ, position, value from ctr where id_champ = ?', $args);
	}
}