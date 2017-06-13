<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
    session_start();
}

$id=$_GET['id'];
$_SESSION['destinataire']=$id;
header ('Location: /ensisocial/page_membre.php');
?>