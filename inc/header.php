<?php
	try {
		$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die('Error:'.$e->getMessage());
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $title; ?> - EnsiSocial</title>
	<meta name="charset" content="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.css"/>
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/autocomplete.js" ></script>
	<script src="js/bootstrap.min.js"></script>
	<script type='text/JavaScript' src="js/memberconnected.js"></script>
</head>

<body onload="javascript:ajax()">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
	<!-- wrap header content -->
	<div class="wrap">
		<header>
			<div class="jumbotron text-center">
				<h1>EnsiSocial</h1>
			</div>
			<?php
			include('navbar.php');
			?>
		</header>
	</div>
	<!-- Wrap all page content -->
	<div id="wrap">
