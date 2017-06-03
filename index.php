<?php
$title="Accueil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

$form=new Form($_POST,"login");
?>

<!-- Connection form -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <form action="connectiontraitement.php" method="post">
        <?php
        echo $form->inputfield('email', 'email', 'Votre email');
        echo $form->inputfield('pwd', 'password', 'Mot de passe');
        ?>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">
            Se rappeler de moi
          </label>
        </div>
        <?php
        echo $form->submit('Se connecter !');
        ?>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <p class="pwd"><a href="/ensisocial/lost_pwd.php">Mot de passe oublié ?</a></p>
    </div>
  </div>
</div>
<!-- /Connection form -->

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
