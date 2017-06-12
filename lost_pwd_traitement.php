<?php
$title="Requête traitée";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
$form= new Form($_POST,"lostpwd");
require 'phpmailer/PHPMailerAutoload.php';
?>
<?php
    
    function randomize($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy0123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

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
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'ensisocial@gmail.com';
        $mail->Password = 'motdepassedebg';
        $mail->setFrom('ensisocial@gmail.com');
        $mail->addAddress($to);
        $mail->isHTML(true);
        //$mail->SMTPDebug=3; //Messages d'erreur
        $mail->Subject = 'Mot de passe oublié - Ensisocial';
        $mail->Body = '<html style="margin:auto;text-align:center;">
            <div style="margin-left:20%;margin-top:20%">
                <p style="
                text-decoration: underline;
                font-weight:bold;
                ">Votre mot de passe temporaire:</p>
                <p>'.$nouvelmdp.'</p>
            </div></html>';
        $mail->AltBody = 'Votre mot de passe temporaire:'.$nouvelmdp;
        $mail->CharSet = 'UTF-8';
        //send the message, check for errors
        if (!$mail->send()) {
            //echo "ERROR: " . $mail->ErrorInfo;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            if($mail->send()){
                echo "<div>Mot de passe envoyé via TLS</div>";
                $req2->execute();
            } else {
                echo $mail->ErrorInfo;
            }
        } else {
            echo "<div>Votre mot de passe a été envoyé à l'adresse ".$to."</div>";
            $req2->execute();
            //echo $mail->ErrorInfo; //affichage des infos de connexion
        }
    }
 ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>