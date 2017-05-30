<?php
$title=$_SESSION['username'];
include("header.php");



if( isset($_SESSION['username']) && isset($_SESSION["pwd"])){
	echo '<p>'.$_SESSION['username']."        ".$_SESSION["pwd"].'</p>'; 
}
echo '<a href="deconnection.php">Déconnection</a>';
?>