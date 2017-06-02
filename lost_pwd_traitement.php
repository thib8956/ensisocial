<?php
$title="Requête traitée";
include('inc/header.php');
$form= new Form($_POST,"lostpwd")
?>

<div>Votre mot de passe a été envoyé à l'adresse mail</div>
<?php
    $to = $_POST["email"]; //destinataire

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to))
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
} //Pour assurer l'affichage chez tout le monde
    $nouvelmdp=md5(rand());

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
        $subject = 'Mot de passe oublié - Ensisocial';
        $message = 'Votre mot de passe temporaire :'.$passage_ligne.$nouvelmdp;
        $headers = 'From: ensisocial@noreply.com' . $passage_ligne .
        'Reply-To: ensisocial@noreply.com' . $passage_ligne .
        'X-Mailer: PHP/' . phpversion(); // a modifier avec le message si on veut un message en html
        $req2= $db->prepare('UPDATE users SET password="'.$hashmdp.'" WHERE email = "'.$to.'"');
        $req2->execute();
        //mail($to, $subject, $message, $headers); //utiliser une adresse qui ne sera pas rejetée
        echo "<div>Votre mot de passe a été envoyé à l'adresse mail ".$to."</div>";
    }
 ?>

<?php
include('inc/footer.php');
?>
