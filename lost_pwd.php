<?php
$title="Mot de passe oublié";
include('inc/header.php');
require "form.php";
$form=new Form($_POST,"lostpwd");
?>

<form action="lost_pwd_traitement.php" method="post" accept-charset="utf-8" class="form-inline">
<?php
    echo $form->inputfield("email","email","Rentrez votre adresse pour qu'on vous renvoie votre mot de passe");
    echo $form->submit("Demander");
?>
    <br>
    <br>
</form>





<?php
include('inc/footer.php');
?>
