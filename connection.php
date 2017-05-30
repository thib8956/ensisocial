<?php
$title="Connection";
include("header.php");
?>
<p> Veuillez entrer vos identifiants</p>
<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline">

	<div class="form-group">
		<label for="username" class="control-label">Nom d'utilisateur</label>
		<input type="text" name="username" class="form-control">
	</div>

	<div class="form-group">
		<label for="psw" class="control-label">Votre mot de passe</label>
		<input type="password" name="psw" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" name="connection" class="btn btn-primary">Connexion</button>
	</div>
	<a href="lost_psw.php" >Mot de passe oublié</a>

<?php
include("footer.php");
?>
