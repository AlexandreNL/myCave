<?php 
require 'connect.php'; 
$email = $_POST['email'];
$password = $_POST['password'];
$index = 'index.php';


if(in_array('', $_POST)) {
	$msg_error = '';
	if(empty($email)) {
		$msg_error .= 'Merci de renseigner votre email<br>';
	}
	if(empty($password)) {
		$msg_error .= 'Merci de renseigner votre mot de passe<br>';
	}	
}
else {
	$email = htmlentities(trim($email), ENT_QUOTES); // faille XSS
	$password = htmlentities(trim($password), ENT_QUOTES);

	$req = $db->prepare("
		SELECT *
		FROM admin a
		WHERE a.email = :email
	");
	$req->bindValue(':email', $email, PDO::PARAM_STR);

	$req->execute();
	$result = $req->fetchObject();
	if(!$result) {
		$msg_error = 'Votre email ou mot de passe est inconnu';
	}
	else {

		if(password_verify($password, $result->password)) {
			$msg_success = 'Vous êtes connecté';
		}
		else {
			$msg_error = 'Votre email ou mot de passe est inconnu';
		}
	}
}

$msg = isset($msg_error);

$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
if(strpos($last_url, '?') !== FALSE) {
	$req_get = strrchr($last_url, '?');
	$last_url = str_replace($req_get, '', $last_url);
}
if($msg) {
	header("Location: $last_url?msg=$msg_error");
}
else {
	$_SESSION['id_admin'] 		= $result->id_admin;
	$_SESSION['email'] 	= $result->email;
	$_SESSION['password'] 	= $result->password;

	header("Location: $index?msg=$msg_success");
}
