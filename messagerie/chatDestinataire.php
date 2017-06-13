<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
    session_start();
}

try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8mb4", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $db->prepare('SELECT firstname, lastname FROM users WHERE id = :id ');
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

$id=$_GET['id'];
$_SESSION['destinataire']=$id;
if($id=='all') {
    $_SESSION['room']='Parler à tout le monde';
}
else {
    $req->execute(array('id' => $id));
    $donnee=$req->fetch();
    $_SESSION['room']=$donnee['firstname'].' '.$donnee['lastname'];
}
header ('Location: /ensisocial/page_membre.php');
?>