<?php
$title = "Connection";
include("header.php");

$req = $db->prepare('SELECT username, password FROM users WHERE username = :pseudo');
$req->execute(array('pseudo'=> $_POST["username"]));
$row = $req->fetch();

/* Vérification du mot de passe.*/
if (password_verify($_POST['pwd'], $row['password'])){
	session_start();
	$_SESSION['username'] = $_POST['username'];
	header ('Location: page_membre.php');
} else {
	echo '<p>Bad username or password</p>';
}
?>