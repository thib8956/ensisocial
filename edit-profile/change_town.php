<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="change_town";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

//Partie de traitement
$stmt = $db->prepare('UPDATE users SET town = :town WHERE id = :id');
$stmt->execute(array(
	'town' => htmlentities($_POST['town']),
	'id' => intval($_SESSION['id'])
	));
//peut etre une page pour valider le changement serait cool en fait pour ça

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
