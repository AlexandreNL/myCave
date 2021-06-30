<?php
if(empty(session_id())) {
	session_start();
}
try
{
	$db = new PDO('mysql:host=localhost;dbname=bdd_mycave;charset=utf8','root','');
}
catch(Exception $e)
{
	die('Erreur: ' . $e->getMessage());
}
?>