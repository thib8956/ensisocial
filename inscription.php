<?php
$title="Inscription";
include("header.php");
?>
<?php
require "form.php";
$form=new Form($_POST,"signin");
?>
<div class="bootstrap-iso">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form action="traitement.php" method="post">
<?php
    echo $form->inputfield("username","string","Nom d'utilisateur",true);
    echo $form->inputfield("password","password","Mot de passe",true);
    echo $form->inputfield("repassword","password","Retapez votre mot de passe",true);
    echo $form->inputfield("firstname","string","prénom");
    echo $form->inputfield("secondname","string","Deuxième prénom");
    echo $form->inputfield("lastname","string","Nom");
    echo $form->inputfield("address","string","Adresse");
    echo $form->inputfield("zipcode","int","Code Postale");
    echo $form->inputfield("town","string","Ville");
    echo $form->inputfield("birth","date","Date de naissance");
    echo $form->inputfield("email","email","Votre email",true);
    echo $form->inputfield("phone","string","Téléphone");
    echo $form->inputsection("formation","string","formation",array("IR" => "Informatique et réseau","AS" =>"AUtomatique et système" ,"meca" => "Mecanique","textile"=>"Textile","FIP" => "Filière par alternance"));
    echo $form->submit("S'inscrire !");

include("footer.php");
?>
