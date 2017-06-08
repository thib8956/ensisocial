<?php
session_start();
$_SESSION['commentUnfold'][$_GET['id']]+=$_GET['value'];
?>
