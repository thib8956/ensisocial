<?php
session_start();

$title=$_SESSION['firstname'];
include("header.php");

echo '<p>Bonjour, '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'</p>';
?>

<div>
    <p><img id="profilepic" href="photoprofil.jpg" ALT="Profile pic" title="Photo de profil"/></p>
</div>

    
<?php    
echo '<a href="disconnection.php">Déconnexion</a>';
?>


<div id="newsstream">
    <p>Insérez ici messages variés</p>
</div>