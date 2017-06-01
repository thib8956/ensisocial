<?php
$title="Requête traitée";
include('inc/header.php');
?>

<?php
     $to      = $_POST["email"];
     $req = $db->prepare('SELECT * FROM users WHERE email = :email');
     $req->execute(array('email'=> $_POST["email"]));
     $nbs = $req->fetchAll();
     if (count($nbs)==0){
         echo "Bad adress";
     } {
        $subject = 'le sujet';
        $message = 'Bonjour !'; //rajouter le mdp ici
        $headers = 'From: ensisocial@noreply.com' . "\r\n" .
        'Reply-To: ensisocial@noreply.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        //mail($to, $subject, $message, $headers); //utiliser une adresse qui ne sera pas rejetée
        echo "<div>Votre mot de passe a été envoyé à l'adresse mail ".$to."</div>";
     }
 ?>

<?php
include('inc/footer.php');
?>
