<?php
$title="Requête traitée";
include('inc/header.php');
?>

<div>Votre mot de passe a été envoyé à l'adresse mail</div>
<?php
     $to      = $_POST["email"];
     $subject = 'le sujet';
     $message = 'Bonjour !'; //rajouter le mdp ici
     $headers = 'From: ensisocial@noreply.com' . "\r\n" .
     'Reply-To: ensisocial@noreply.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
 ?>

<?php
include('inc/footer.php');
?>
