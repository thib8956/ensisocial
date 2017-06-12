<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

require_once 'form.php';
$FORMATIONS = array('IR' => 'Informatique et Réseaux',
  'AS' =>'Automatique et Systèmes',
  'meca' => 'Mécanique',
  'textile' => 'Textile et fibres',
  'FIP' => 'Filière par alternance');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $title; ?> - EnsiSocial</title>
	<meta name="charset" content="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="icon" type="image/png" href="/ensisocial/favicon.png" />
    <link rel="stylesheet" href="/ensisocial/css/jquery-ui.css"/>
	<link rel="stylesheet" href="/ensisocial/css/bootstrap.min.css"/>
	<!-- <link rel="stylesheet" href="css/styleindex.css" /> -->
</head>

<body onload="javascript:refresh('memberconnected'); javascript:refresh('page_membre');" style="<?php echo $background?>">
	<?php
	include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/navbar.php');
	?>
	<!-- Wrap all page content -->
	<div id="wrap" style="padding-top: 100px;">
