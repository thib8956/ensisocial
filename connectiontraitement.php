<?php
$title = "Connection";
include('inc/header.php');

$req = $db->prepare('SELECT email, password, firstname, lastname FROM users WHERE email = :email');
$req->execute(array('email'=> $_POST["email"]));
$row = $req->fetch();

/* Vérification du mot de passe.*/
if (password_verify($_POST['pwd'], $row['password'])){
	session_start();
	$_SESSION['email'] = $row['email'];
    $_SESSION['firstname'] = $row['firstname'];
     $_SESSION['lastname'] = $row['lastname'];
	header ('Location: page_membre.php');
} else {
	echo '<p>Bad email or password</p>';
}
?>
