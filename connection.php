<?php
$title="Connection";
include('inc/header.php');
?>
<p> Veuillez entrer vos identifiants</p>
<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline">

	<div class="form-group">
		<label for="email" class="control-label">Addresse mail</label>
		<input type="text" name="email" class="form-control">
	</div>

	<div class="form-group">
		<label for="pwd" class="control-label">Votre mot de passe</label>
		<input type="password" name="pwd" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" name="connection" class="btn btn-primary">Connexion</button>
	</div>
	<a href="lost_pwd.php" >Mot de passe oublié</a>

<?php
include('inc/footer.php');
?>
