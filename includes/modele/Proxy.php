<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class Proxy
{
	public static function addPublicProxy($ip){
		$args = func_get_args();
		query('Insert into proxy(ip) values(?)', $args)
	}

	public static function addPrivateProxy($id_client, $ip){
		$args = func_get_args();
		query('Insert into proxy(id_client, ip) values(?,?)', $args)
	}
}