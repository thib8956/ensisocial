<?php
function newMail($mail,$subject,$body,$altbody="Message mal lu") {
    $mail->isSMTP();
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'ensisocial@gmail.com';
    $mail->Password = 'motdepassedebg';
    $mail->setFrom('ensisocial@gmail.com');
    $mail->isHTML(true);
    //$mail->SMTPDebug=3; //Messages d'erreur
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $altbody;
    $mail->CharSet = 'UTF-8';
}

function sendMail($mail,$to) {
    //send the message, check for errors
    $mail->addAddress($to);
    if (!$mail->send()) {
        //echo "ERROR: " . $mail->ErrorInfo;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        if($mail->send()){
            echo "<div>Mail envoyé via TLS</div>";
            return 2;
        } else {
            echo $mail->ErrorInfo;
            return 3;
        }
    } else {
        echo "<div>Votre mail a été envoyé à l'adresse ".$to."</div>";
        return 1;
        //echo $mail->ErrorInfo; //affichage des infos de connexion
    }
}
?>