<?php
	/* Connexion à la base de données.*/
	try {
		$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
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
	<link rel="stylesheet" href="style.css"/>
</head>
<body>
	<header >
		<h1>EnsiSocial</h1>
		<nav>
			<ul>
				<li><a href="inscription.php" title="inscrition">Inscription</a></li>
				<li><a href="connection.php" title="connection">Connection</a></li>
			</ul>
		</nav>
	</header>
