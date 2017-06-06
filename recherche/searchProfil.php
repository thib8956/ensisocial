<?php
session_start();
$title="Recherche";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
echo $_GET['id'];
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
