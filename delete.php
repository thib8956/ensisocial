<?php
//connection BDD
session_start();
/*include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');*/

try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$memberconnected = $db-> query('SELECT lastname, firstname, connected FROM users');
} catch (PDOException $e) {
	die('Error:'.$e->getMessage());
}

$newsfeedid = $_GET['id'];
$connectedid = $_SESSION['id'] ;

$db->query("SELECT * FROM newsfeed");

// Vérifier auteur
$req=$db->prepare("SELECT authorid FROM authornews JOIN newsfeed ON newsfeed.id = authornews.newsfeedid WHERE newsfeed.id=:newsid");
$req->execute(array('newsid' => $newsfeedid));
$nb1 = $req->fetch();


if ( $nb1['authorid'] == $connectedid ){
	// Delete POST
	$stmt = $db->prepare('DELETE  FROM newsfeed  WHERE id=:newsid');
	$stmt->execute(array('newsid' => $newsfeedid));

	// Delete orphaned comments
	$db->query('
		DELETE `comments`
		 FROM (`comments` LEFT JOIN `newscomment` ON `newscomment`.`commentid` = `comments`.`id`)
		WHERE `newscomment`.`commentid` IS NULL
		');

	header('Location: page_membre.php');
	exit();
} else {
	echo 'erreur';
	header('Location: page_membre.php');
	exit();
}

// fermeture de la connection à la db
if ($db) $db = NULL;
?>
