<?php 
//connection BDD
session_start();


include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try{   $bdd = new PDO('mysql:host=localhost;dbname=ensisocial;charset=utf8','root','');
echo 'ok';}

catch (Exception $e){ 
die('Erreur : ' . $e->getMessage());
}
 
$commentid = $_GET['id'];
$connectedid = $_SESSION['id'] ;

$bdd->query("SELECT * FROM comments");
// Vérifier auteur



$req=$bdd->query("SELECT authorid FROM authorcomment JOIN comments ON comments.id = authorcomment.commentid WHERE comments.id=".$commentid);
$nb1 = $req->fetch();


if ( $nb1['authorid'] == $connectedid ){
	// Delete
	$bdd->query("delete  FROM comments  where id=".$commentid);
	// header('Location: page_membre.php');
	exit();
	}


// fermeture de la connection à la bdd
if ($bdd) {$bdd = NULL;}?>
