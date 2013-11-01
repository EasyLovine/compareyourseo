<?php
$host= "localhost";
$port="3306";
$bd="semclient3";
$user="semioche";
$pw="6itcBKh1uGh3";

$co = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$bd, $user, $pw);
$co->exec("SET CHARACTER SET utf8");

function startsWith($haystack, $needle)
{
    return strpos(strtolower($haystack), strtolower($needle)) === 0;
}

function query($rqt, $data){
	global $co;
	$sth  = $co->prepare($rqt);
	$sth->execute($data);
	$sth->setFetchMode(PDO::FETCH_OBJ);
	if(!startsWith($rqt, "insert"))
		return $sth->fetchAll();
	else
		return $co->lastInsertId();
}
?>
