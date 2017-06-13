<?php
$title="Requête traitée";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
$form= new Form($_POST,"lostpwd");
require 'phpmailer/PHPMailerAutoload.php';
?>
<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/randomize.php');
    $nouvelmdp=randomize(8);
    $to=$_POST['email'];
    $options = [
          'cost' => 11
        ];
    $hashmdp = password_hash($nouvelmdp, PASSWORD_BCRYPT, $options);

    $req = $db->prepare('SELECT * FROM users WHERE email = :email');
    $req->execute(array('email'=> $_POST["email"]));
    $nbs = $req->fetchAll();
    if (count($nbs)==0){
        echo "<div class=\"alert alert-danger\">Pas de compte lié à cette adresse</div>";
        echo '<form action="lost_pwd_traitement.php" method="post" accept-charset="utf-8" class="form-inline">';
        echo $form->inputfield("email","email","Rentrez votre adresse pour qu'on vous renvoie votre mot de passe");
        echo $form->submit("Demander");
        echo '<br><br></form>'; //affichage à améliorer
    } else {
        
        $req2= $db->prepare('UPDATE users SET password="'.$hashmdp.'" WHERE email = "'.$to.'"');
        include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/mail.php');
        $mail = new PHPMailer;
        newMail($mail,'Mot de passe oublié - Ensisocial','<html style="margin:auto;text-align:center;">
            <div style="margin-left:20%;margin-top:20%">
                <p style="text-decoration: underline; font-weight:bold;">Votre mot de passe temporaire:</p>
                <p>'.$nouvelmdp.'</p>
            </div></html>','Votre mot de passe temporaire:'.$nouvelmdp);
        $test=sendMail($mail,$to);
        if ($test == 1 || $test ==2) {$req2->execute();}
    } 
 ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>