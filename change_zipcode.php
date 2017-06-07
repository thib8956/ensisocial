<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title="change_zipcode";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

//Partie de traitement
    $req2= $db->prepare('UPDATE users SET zipcode="'.$_POST['zipcode'].'" WHERE id='.$_SESSION['id']);
    $req2->execute();
//peut etre une page pour valider le changement serait cool en fait pour ça

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: profile.php');
?>