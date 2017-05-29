<?php
$title="Connection";
include("header.php");
?>

<form action="connectiontraitement.php" method="post" accept-charset="utf-8">
	<p>
		<label for="mail">adresse e-mail</label>
		<input type="email" name="mail">
	</p>
	<p>
		<label for="psw">Votre mot de passe</label>
		<input type="password" name="psw">
	</p>
</form>

<?php
include("footer.php");
?>