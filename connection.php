<?php
$title="Connexion";
include("header.php");
require 'form.php';
$form=new Form($_POST,"connection");
?>
<p> Veuillez entrer vos identifiants</p>
<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline" >
	
<?php
	echo $form->inputfield("username","string","Nom d'utilisateur");
	echo $form->inputfield("pwd","string","Mot de Passe");
	echo $form->submit('Connexion');
?>
</form>

<?php
include("footer.php");
?>
