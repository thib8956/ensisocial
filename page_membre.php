<?php
session_start();

$title=$_SESSION['username'];
include("header.php");

echo '<p>Bonjour, '.$_SESSION['username'].'</p>';

echo '<a href="disconnection.php">Déconnexion</a>';
?>

<div>
    <p><img id="profilepic" href="photoprofil.jpg"/></p>
</div>
<div id="newsstream">
    <p>Insérez ici messages variés</p>
</div>