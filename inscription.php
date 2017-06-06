<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

$form = new Form($_POST,"signin");

?>
<div class="bootstrap-iso">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form action="traitement.php" method="post">
                    <?php
                    echo $form->inputfield("email","email","Votre email",true);
                    echo $form->inputfield("password","password","Mot de passe",true);
                    echo $form->inputfield("repassword","password","Retapez votre mot de passe",true);
                    echo $form->inputfield("firstname","string","Prénom",true);
                    echo $form->inputfield("lastname","string","Nom",true);
                    echo $form->inputfield("address","string","Adresse");
                    echo $form->inputfield("zipcode","int","Code Postale");
                    echo $form->inputfield("town","string","Ville");
                    echo $form->inputfield("birth","date","Date de naissance");
                    echo $form->inputfield("phone","string","Téléphone");
                    echo $form->inputsection("formation","string","formation",array("IR" => "Informatique et Réseaux","AS" =>"Automatique et Systèmes" ,"meca" => "Mécanique","textile"=>"Textile","FIP" => "Filière par alternance"));

<script src="/ensisocial/js/treatment.js">
</script>

<div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form onsubmit="return verifForm(this)" action="traitement.php" method="post">
        <?php
        echo $form->inputfield("email","email","Votre email",true);
        echo $form->inputfield("password","password","Mot de passe",true);
        echo $form->inputfield("repassword","password","Retapez votre mot de passe",true);
        echo $form->inputfield("firstname","string","Prénom",true);
        echo $form->inputfield("lastname","string","Nom",true);
        echo $form->inputfield("address","string","Adresse");
        echo $form->inputfield("zipcode","int","Code Postale");
        echo $form->inputfield("town","string","Ville");
        echo $form->inputfield("birth","date","Date de naissance");
        echo $form->inputfield("phone","string","Téléphone");
        echo $form->inputsection("formation","string","formation",
            array("IR" => "Informatique et Réseaux",
              "AS" =>"Automatique et Systèmes",
              "meca" => "Mécanique",
              "textile" => "Textile",
              "FIP" => "Filière par alternance"));
        echo $form->submit("S'inscrire !");
        ?>
    </form>
</div>
</div>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
