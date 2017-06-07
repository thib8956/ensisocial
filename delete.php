<?php 
//connection BDD
session_start();


include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try{   $bdd = new PDO('mysql:host=localhost;dbname=ensisocial;charset=utf8','root','');
echo 'ok';}

catch (Exception $e){ 
die('Erreur : ' . $e->getMessage());
}
 
$newsfeedid = $_GET['id'];
$connectedid = $_SESSION['id'] ;

$bdd->query("SELECT * FROM newsfeed");
// Vérifier auteur



$req=$bdd->query("SELECT authorid FROM authornews JOIN newsfeed ON newsfeed.id = authornews.newsfeedid WHERE newsfeed.id=".$newsfeedid);
$nb1 = $req->fetch();


if ( $nb1['authorid'] == $connectedid ){
	// Delete
	$bdd->query("delete  FROM newsfeed  where id=".$newsfeedid);
	header('Location: page_membre.php');
	exit();
	}

else { echo 'erreur'; 
	header('Location: page_membre.php');
	exit();}

// fermeture de la connection à la bdd
if ($bdd) {$bdd = NULL;}?>
