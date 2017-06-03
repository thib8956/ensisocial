<?php
$title="Requête traitée";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
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
        
        $separation = "-----=".md5(rand()); //Pour séparer les différents types
        $headers = 'From: ensisocial@noreply.com' . $passage_ligne .
        'Reply-To: ensisocial@noreply.com' . $passage_ligne .
        'MIME-Version: 1.0'. $passage_ligne .
        'Content-Type: multipart/alternative;'. //Pour pouvoir mettre plusieurs types dans le message, genre un html et le texte alternatif
        'boundary="'.$separation.'"'.$passage_ligne;
        
        $message_txt = 'Votre mot de passe temporaire: '.$nouvelmdp;
        $message_html = '<html><div style="height:50px;background-color:aqua;">'.$message_txt.'</div></html>'; //Messages à modifier selon le mail
        
        $message =
            $passage_ligne."--".$separation. $passage_ligne . //mettre avant chaque partie
            'Content-Type:text/plain;charset="utf-8"'.$passage_ligne.
            'Content-Transfer-Encoding: 8bit'.
            $passage_ligne.$message_txt.$passage_ligne. //Message texte
            
            $passage_ligne."--".$separation.$passage_ligne.           
            'Content-Type:text/html;charset="utf-8"'. $passage_ligne .
            'Content-Transfer-Encoding: 8bit'. $passage_ligne . 
            $passage_ligne.$message_html.$passage_ligne // Message html
            ; 
        
        $req2= $db->prepare('UPDATE users SET password="'.$hashmdp.'" WHERE email = "'.$to.'"');
        $req2->execute();
        mail($to, $subject, $message, $headers); //utiliser une adresse qui ne sera pas rejetée - décommenter pour tester
        echo "<div>Votre mot de passe a été envoyé à l'adresse ".$to."</div>";
    }
 ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
