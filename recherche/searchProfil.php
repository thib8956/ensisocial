<?php
session_start();
$title="Recherche";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
createCookie('test', 'prout', 0);
echo $_COOKIE['test'];
echo $_COOKIE['searchID'];
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
