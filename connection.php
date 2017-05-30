<?php
$title="Connection";
include("header.php");
?>
<p> Veuillez vos identifiants
<form action="connectiontraitement.php" method="post" accept-charset="utf-8">

	<div class="">
		<label for="username">nom d'utilisateur</label>
		<input type="text" name="username">
		<span class="error-message"></span>
	</div>
	<div class="">
		<label for="psw">Votre mot de passe</label>
		<input type="password" name="psw">
		<span class="error-message"></span>
	</div>
	<div class="">
		<input type="submit" name="connection" value="connection">
	</div>
	<<a href="lost_psw.php" >mot de passe oublié</a>

</form>

<?php
include("footer.php");
?>