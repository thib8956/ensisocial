<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="change_formation";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

//Partie de traitement
$stmt = $db->prepare('UPDATE users SET formation = :formation WHERE id = :id');
$stmt->execute(array(
	'formation' => htmlentities($_POST['formation']),
	'id' => intval($_SESSION['id'])
	));
// Update session variables
if (isset($_SESSION['formation'])) $_SESSION['formation'] = htmlentities($_POST['formation']);

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
