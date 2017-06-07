<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}

$title="Profil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>
