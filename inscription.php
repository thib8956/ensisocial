<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

$form = new Form($_POST,"signin");

?>

<script src="/ensisocial/js/treatment.js">
</script>

<div class="container">
  <div class="row">
   <div class="col-md-8 col-md-offset-2">
    <form id="inscription" onsubmit="return verifForm(this)" action="traitement.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <?php
        // MAX_FILE_SIZE (in bytes) for profile picture (4 MiB).
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />';
        echo $form->inputfile('picture', 'Choisissez une image de profil');
        echo $form->inputfield(
          'email',
          'email',
          'Votre email',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-envelope'
          );
        echo $form->inputfield(
          'password',
          'password',
          'Mot de passe <small>(6 caractères minimum)</small>',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-lock'
          );
        echo $form->inputfield('repassword',
          'password',
          'Retapez votre mot de passe',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-lock'
          );
        echo $form->inputfield('firstname',
          'text',
          'Prénom',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-user'
          );
        echo $form->inputfield('lastname',
          'text',
          'Nom',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-user'
          );
        echo $form->inputfield('address',
          'text',
          'Adresse',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('zipcode',
          'text',
          'Code Postal',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('town',
          'text',
          'Ville',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('birth',
          'text',
          'Date de naissance',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-calendar'
          );
        echo $form->inputfield('phone',
          'text',
          'Téléphone',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $glyphicon='glyphicon-earphone'
          );
        echo $form->inputsection('formation','string','formation',
            array('IR' => 'Informatique et Réseaux',
              'AS' =>'Automatique et Systèmes',
              'meca' => 'Mécanique',
              'textile' => 'Textile',
              'FIP' => 'Filière par alternance',
              'enseignant' =>'enseignant',
              'personnelUha' => 'personnel de l\'uha'));
        echo $form->submit('S\'inscrire !');
        ?>
    </form>
</div>
</div>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
