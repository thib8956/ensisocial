<?php
$title = "Connexion";
include_once('inc/header.php');

$req = $db->prepare('SELECT * FROM users WHERE email = :email');
$req->execute(array('email'=> $_POST['email']));
$row = $req->fetch();

$connected = $db->prepare("UPDATE `users` SET `connected` = 1 WHERE `users`.`id` = :id");
$connected->execute(array('id' => $row['id'] ));

/* Vérification du mot de passe.*/
if (password_verify($_POST['pwd'], $row['password'])){
	session_start();
	$_SESSION['formation']=$row['formation'];
	$_SESSION['town']=$row['town'];
	$_SESSION['id']=$row['id'];
	$_SESSION['email'] = $row['email'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['birth']=$row['birth'];

	header ('Location: page_membre.php');
} else {
	echo '<p>Bad email or password</p>';
}
?>
