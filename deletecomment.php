<?php
//connection BDD
session_start();


include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try{
	$bdd = new PDO('mysql:host=localhost;dbname=ensisocial;charset=utf8','root','');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

$commentid = $_GET['id'];
$connectedid = $_SESSION['id'] ;

$req = $bdd->query("SELECT authorid FROM authorcomment JOIN comments ON comments.id = authorcomment.commentid WHERE comments.id=".$commentid);
$nb1 = $req->fetch();

if ($nb1['authorid'] == $connectedid){
	// Delete comment
	$bdd->query("DELETE  FROM comments  WHERE id=".$commentid);
}


// fermeture de la connection à la bdd
if ($bdd) {
	$bdd = NULL;
}
?>
