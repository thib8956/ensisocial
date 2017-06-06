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
            surligne(champ,true);
            return false;
        }
        else if (champ.value.includes("{") || champ.value.includes("/") || champ.value.includes("\\") || champ.value.includes("#") ||
                champ.value.includes("(") || champ.value.includes("[") || champ.value.includes("$") || champ.value.includes(";") ||
                champ.value.includes(">") || champ.value.includes("<") || champ.value.includes("*") || champ.value.includes("%"))
        {
            alert("Don't be evil !");
            return false;
        }
        else
        {
            surligne(champ,false);
            return true;
        }
    }
    function verifPass(champ1,champ2)
    {
        if(champ1.value == champ2.value && champ1.value!='' && champ2.value!='') {
            return true;
        }

        else
            return false;
    }
    function verifMail(champ)
    {
        if (champ.value.includes("@uha.fr"))
        {
            return true;
        }
        else
        {
            return false;
        }
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
            if (verifPass(f.password,f.repassword))
            {
                if (verifMail(f.email))
                {
                    alert("Adresse UHA");
                    return true;
                }
                else
                {
                    alert("Non UHA détectée");
                    return true;
                }
            }
            else
            {
                alert("Vos mots de passe ne sont pas similaires");
                f.repassword.style.backgroundColor='#FFEAEA';
                f.repassword.style.color='#000000';
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
