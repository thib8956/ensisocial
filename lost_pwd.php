<?php
$title="Mot de passe oublié";
include("header.php");
?>

<form action="lost_pwd_traitement.php" method="post" accept-charset="utf-8" class="form-inline">
	<div class="form-group">
		<label for="mail" class="control-label">Rentrez votre adresse pour qu'on vous renvoie votre mot de passe</label>
		<input type="email" name="mail" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" name="valider" class="btn btn-primary">Valider</button>
	</div>
    <br>
    <br>
</form>





<?php
include("footer.php");
?>