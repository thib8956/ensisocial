<?php
$title="Accueil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

$form=new Form($_POST,"login");
?>

<!-- Connection form -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title">Connexion</div>
          <a href="/ensisocial/lost_pwd.php" class="small pull-right">Mot de passe oublié ?</a>
        </div>
        <div class="panel-body" >
          <form action="connectiontraitement.php" method="post">
            <?php
            echo $form->inputfield(
              'email',
              'email',
              'Votre email',
              $mandatory=TRUE,
              $classlabel='control-label',
              $classselect='form-control',
              $id='',
              $glyphicon='glyphicon-envelope'
              );
            echo $form->inputfield(
              'pwd',
              'password',
              'Mot de passe',
              $mandatory=TRUE,
              $classlabel='control-label',
              $classselect='form-control',
              $id='',
              $glyphicon='glyphicon-lock'
              );
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
      </div>
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

  <!-- /Connection form -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
  ?>
