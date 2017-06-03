<?php

$title="Connexion";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
$form=new Form($_POST,"connection");
?>
<p> Veuillez entrer vos identifiants</p>
<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline" >
<?php
	echo $form->inputfield("email","email","Nom d'utilisateur");
	echo $form->inputfield("pwd","password","Mot de Passe");
	echo $form->submit('Connexion');
    echo "<a href=\"lost_pwd.php\">Mot de passe oublié?</a>";
?>
</form>
<?php
include_once($_SERVER['DOCUMENT_ROOT']'/ensisocial/inc/footer.php');
?>
