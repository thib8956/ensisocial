<?php

$title="Connexion";
include("inc/header.php");
$form=new Form($_POST,"connection");
?>
<p> Veuillez entrer vos identifiants</p>
<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline" >
<?php
	echo $form->inputfield("email","email","Nom d'utilisateur");
	echo $form->inputfield("pwd","password","Mot de Passe");
	echo $form->submit('Connexion');
?>
</form>

<?php
include('inc/footer.php');
?>
