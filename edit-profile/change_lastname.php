<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="change_lastname";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

//Partie de traitement
$stmt = $db->prepare('UPDATE users SET lastname = :lname WHERE id = :id');
$stmt->execute(array(
	'lname' => htmlentities($_POST['lastname']),
	'id' => intval($_SESSION['id'])
	));
// Update session variable
if (isset($_SESSION['lastname'])) $_SESSION['lastname'] = htmlentities($_POST['lastname']);

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
