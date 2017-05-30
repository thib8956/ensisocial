<?php
$title="Connection";
include("header.php");

$pass=$_POST["psw"];
$req = $db-> prepare('Select username from users where username=:pseudo AND password = :password');
$req->execute(array('pseudo'=> $_POST["username"],'password' =>$pass));

$resultat=$req->fetch();

if(!$resultat){
	echo'Mauvais identifiant ou mot de passe!';
}
else{
	session_start();
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['pwd'] = $_POST['pwd'];
	header ('location: page_membre.php');

	echo 'Vous êtes connecté!';
	echo '<a href="deconnection.php"><input type="button" value="Déconnexion"></a>';
}

?>
