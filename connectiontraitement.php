<?php
$title = "Connexion";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
    $req = $db->prepare('SELECT * FROM users WHERE email = :email');
    $req->execute(array('email'=> $_POST['email']));
    $row = $req->fetch();

    $connected = $db->prepare("UPDATE `users` SET `connected` = 1 WHERE `users`.`id` = :id");
    $connected->execute(array('id' => $row['id'] ));
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">';
    die('Error:'.$e->getMessage());
    echo '</div>';
}

/* Vérification du mot de passe.*/
if (password_verify($_POST['pwd'], $row['password'])){
	session_start();
	$_SESSION['formation']=$row['formation'];
	$_SESSION['town'] = $row['town'];
	$_SESSION['id'] = $row['id'];
	$_SESSION['email'] = $row['email'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['birth'] = $row['birth'];

    setcookie("userid", $_SESSION['id'], 0);
    setcookie("prenom", $_SESSION['firstname'], 0);
    setcookie("nom", $_SESSION['lastname'], 0);
    $colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
    $num_colour = array_rand($colours);
    setcookie("color", $colours[$num_colour], 0);

    header ('Location: page_membre.php');
} else {
	echo '<p>Bad email or password</p>';
}
?>
