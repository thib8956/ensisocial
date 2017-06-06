<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

$form = new Form($_POST,"signin");
?>

<script type="text/javascript">
    function surligne(champ, erreur)
    {
        if(erreur)
        {
            champ.style.backgroundColor='#FFEAEA';
            champ.style.color='#000000';
        }
        else
        {
            champ.style.backgroundColor='';
            champ.style.color='';
        }
    }
    function verifText(champ)
    {
        if(champ.value=='')
        {
            surligne(champ, true);
            return false;
        }
        else
        {
            surligne(champ, false);
            return true;
        }
    }
    function verifPass(champ1,champ2)
    {
        if(champ1.value === champ2.value && champ1.value!='' && champ2.value!='') {
            return true;
        }

        else
            return false;
    }
    function verifMail(champ)
    {

    }
    function verifForm(f)
    {
        var email_Ok = verifText(f.email);
        var password_Ok = verifText(f.password);
        var repassword_Ok = verifText(f.repassword);
        var firstname_Ok = verifText(f.firstname);
        var lastname_Ok = verifText(f.lastname);
        var pass = f.password.value;
        var repass = f.repassword.value;
        if(email_Ok && password_Ok && repassword_Ok && firstname_Ok && lastname_Ok)
        {
            if (pass === repass)
            {
                return true;
            }
            else
            {
                surligne(repassword,true);
                alert("Vos mots de passe ne sont pas similaires");
                return false;
            }
        }
        else
        {
            alert("Merci de bien vouloir remplir tous les champs en rose");
            return false;
        }
    }
</script>

<div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form onsubmit="return verifForm(this)" action="traitement.php" method="post" enctype="multipart/form-data">
        <?php
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="12345" />';
        echo $form->inputimg("picture", "Choisissez une image de profil");
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
