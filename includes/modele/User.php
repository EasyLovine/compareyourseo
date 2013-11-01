<?php
require_once(realpath(dirname(__FILE__).'/../utils/bdd.php'));

class User{
	public static function newUser($nom, $prenom, $ent,  $email, $mdp, $salt, $verif, $phone){
		$args = func_get_args();
		query('Insert into client(nom, prenom, entreprise, email, mdp, salt, verif, telephone) values(?,?,?,?,?,?,?,?)', $args);
	}

	public static function updateUser($nom, $prenom, $ent, $phone, $id){
		$args = func_get_args();
		query('Update client set nom = ?, prenom = ?, entreprise = ?, email = ?, telephone = ? where id_client = ? ', $args);
	}

	public static function changePassword($oldPw, $newPw, $id){
		$q = query('select mdp, salt from client where id_client = ?', array($id));
		$salt = $q[0]->salt;
		$recupPw = $q[0]->mdp;
		$newPw = crypt($newPw, $salt);
		if($newPw == $recupPw){
			query('Update client set mdp = ? where id_client = ?', array($newPw, $id));
			return true;
		}
		return false;
	}

	public static function changeEmail($pw, $newEmail, $id){
		$q = query('select mdp from client where id_client = ?', array($id));
		$salt = $q[0]->salt;
		$recupPw = $q[0]->mdp;
		if(crypt($pw, $salt) == $recupPw){
			query('Update client set email = ? where id_client = ?', array($newEmail, $id));
			return true;
		}
		return false;
	}

	public static function getPW($email){
		$args = func_get_args();
		return query('select id_client, salt, mdp from client where email = ? and verif is null', $args);
	}

	public static function getVerif($verif, $mail){
		$args = func_get_args();
		return query("select verif from client where verif = ? and email = ? and verif is not null", $args);
	}

	public static function setVerifNull($mail){
		$args = func_get_args();
		return query("update client set verif = NULL where email = ?", $args);
	}
}