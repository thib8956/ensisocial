<?php
	/* Connexion à la base de données.*/
	try {
		$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die('Error:'.$e->getMessage());
	}
	// $result = $db->prepare('SELECT * FROM users;');
	// while ($result->fetch()){
	// 	echo '<p>Test</p>'.$result['Nom_utilisateur'];
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - EnsiSocial</title>
	<meta name="charset" content="utf8">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
	<header >
		<div class="jumbotron text-center">
			<h1>EnsiSocial</h1>
		</div>
		<?php
			include('navbar.php');
		?>
	</header>
