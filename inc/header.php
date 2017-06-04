<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

require_once 'form.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $title; ?> - EnsiSocial</title>
	<meta name="charset" content="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/ensisocial/css/jquery-ui.css"/>
	<link rel="stylesheet" href="/ensisocial/css/bootstrap.min.css"/>
	<!-- <link rel="stylesheet" href="css/styleindex.css" /> -->
</head>

<body onload="javascript:refresh()">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
	<!-- wrap header content -->
	<div class="wrap">
		<header>
			<div class="jumbotron text-center">
				<h1>EnsiSocial</h1>
			</div>
			<?php
			include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/navbar.php');
			?>
		</header>
	</div>

	<!-- Wrap all page content -->
	<div id="wrap" style="padding-top: 100px;">
