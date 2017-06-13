<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8mb4", "root", "");
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
  'FIP' => 'Filière par alternance',
  'enseignant' =>'enseignant',
  'personnelUha' => 'personnel de l\'uha');
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
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="/ensisocial/css/custom.css">
	<!-- CSS Themes -->
	<?php
		if(session_status() == 2){
			if (isset($_SESSION['formation'])){
				echo '<link rel="stylesheet" href="/ensisocial/css/themes/theme_'.$_SESSION['formation'].'.css" />';
			}
		}
	 ?>
</head>

<body onload="javascript:refresh('memberconnected'); javascript:refresh('page_membre');">
	<?php
	include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/navbar.php');
	?>
	<!-- Wrap all page content -->
	<div class="container-fluid" style="padding-top: 150px;">
