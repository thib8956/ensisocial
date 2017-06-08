<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="Changer la photo";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
