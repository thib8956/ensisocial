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
    <form onsubmit="return verifForm(this)" action="traitement.php" method="post" enctype="multipart/form-data">
        <?php
        // MAX_FILE_SIZE (in bytes) for profile picture (4 MiB).
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />';
        echo $form->inputfile('picture', 'Choisissez une image de profil');
        echo $form->inputfield('email',
          'email',
          'Votre email',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-envelope'
          );
        echo $form->inputfield(
          'password',
          'password',
          'Mot de passe',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-lock'
          );
        echo $form->inputfield('repassword',
          'password',
          'Retapez votre mot de passe',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-lock'
          );
        echo $form->inputfield('firstname',
          'string',
          'Prénom',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-user'
          );
        echo $form->inputfield('lastname',
          'string',
          'Nom',
          $mandatory=TRUE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-user'
          );
        echo $form->inputfield('address',
          'string',
          'Adresse',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('zipcode',
          'int',
          'Code Postal',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('town',
          'string',
          'Ville',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-home'
          );
        echo $form->inputfield('birth',
          'date',
          'Date de naissance',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-calendar'
          );
        echo $form->inputfield('phone',
          'string',
          'Téléphone',
          $mandatory=FALSE,
          $classlabel='control-label',
          $classselect='form-control',
          $id='email',
          $glyphicon='glyphicon-earphone'
          );
        echo $form->inputsection('formation','string','formation',
            array('IR' => 'Informatique et Réseaux',
              'AS' =>'Automatique et Systèmes',
              'meca' => 'Mécanique',
              'textile' => 'Textile',
              'FIP' => 'Filière par alternance'));
        echo $form->submit('S\'inscrire !');
        ?>
    </form>
</div>
</div>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
