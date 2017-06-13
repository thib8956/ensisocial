<?php
$title="Mot de passe oublié";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
$form=new Form($_POST,"lostpwd");

?>

<form action="lost_pwd_traitement.php" method="post" accept-charset="utf-8" class="form-inline">
    <?php
        echo $form->inputfield("email","email","Rentrez votre adresse pour qu'on vous renvoie votre mot de passe");
        echo $form->submit("Valider");
    ?>
</form>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
