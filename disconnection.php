<?php
	// TODO : suppression du cookie à la déconnexion ?
	include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
	session_start();
	//$connected=$db->prepare("UPDATE `users` SET `connected` = 0 WHERE `users`.`id` =:id ;");
	//$connected->execute(array('id' => $_SESSION['id'] ));
	session_unset();
	session_destroy();
	header('location: index.php');
?>
