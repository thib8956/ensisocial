<?php
session_start();

$title=$_SESSION['username'];
include("header.php");

if (isset($_SESSION['username'])){
	echo '<p>Bonjour, '.$_SESSION['username'].'</p>';
}

echo '<a href="disconnection.php">Déconnexion</a>';
?>