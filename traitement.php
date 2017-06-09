<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/upload.php');

$answer = $db->query('SELECT email FROM users');

// Récupération d'inscription puis découpe avec substr
$start = 0;
$string = get_include_contents('inscription.php');
$utile = substr ($string, $start);

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}

// Envoi mail
/*
$objet = 'Confirmation de votre inscription EnsiSocial' ;
$contenu = '
<html>
<head>
   <title>Vous vous êtes inscrit(e) sur EnsiSocial</title>
</head>
<body>
   <p>Bonjour '.$_POST['firstname'].' '.$_POST['lastname'].'</p>
   <p>Vous venez de vous inscrire sur le site EnsiSocial avec les informations suivantes :<br>  -Adresse mail:'.$_POST['email'].'<br>
   -Mot de passe'.$_POST['password'].'</p>
</body>
</html>';
$to = ".$_POST['email'].";
$headers = 'From: webmaster@example.com' . "\r\n" .
'Reply-To: webmaster@example.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
     */

if(isset($_POST['signin'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
        while($data = $answer->fetch()) {
            if ($_POST['email'] == $data['email']){
                echo '<div class="alert alert-danger">';
                echo "<p>Adresse mail déjà utilisée.</p>";
                echo '</div>';
                echo $utile;
                exit;
            } elseif($_POST["password"] == $_POST["repassword"]){
                echo '<p>Mot de passe OK.</p>';
                // Generate an unique filename for the profile pic.
                $fname = md5(uniqid(rand(), true));
                $ext = '.'.substr(strrchr($_FILES['picture']['name'], '.'), 1); // Get file extension
                $dst = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/avatar/'.$fname.$ext;
                // Upload profile picture
                upload('picture', $dst);
                fillDatabase($db, $fname.$ext);
                //Envoi du mail
                //mail($to, $objet, $contenu, $headers);
                echo '<p>Vous êtes bien inscrit. Allez voir vos mails ;)</p>';
                exit;
            } else {
                echo '<div class="alert alert-danger">';
                echo "Vos 2 mots de passe ne sont pas similaires.";
                echo '</div>';
                echo $utile;
                exit;
            }
        }
    }
}


/**
 * Fill the `users` table with the values given in the inscription form.
 * @param  [type] $connection    Connection to the PDO.
 * @param  [type] $profile_pic   Filename of the profile picture.
 */
function fillDatabase($connection, $profile_pic) {
    if ($profile_pic == ""){
        $profile_pic = 'default-profile.png';
    }
	/* Chiffrement du mot de passe.*/
	$options = [
          'cost' => 11
        ];
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

    try {
        $stmt = $connection->prepare(
            'INSERT INTO users (`email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `connected`, `profile_pic`)
            VALUES (:email, :password, :firstname, :lastname, :address, :zipcode, :town, :birth, :phone, :formation, FALSE,:filename)'
            );
        $stmt->execute(array(
                    'email' => $_POST['email'],
                    'password' => $hash, // Mot de passe hashé avec bcrypt
                    'firstname' => htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8'),
                    'lastname' => htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8'),
                    'address' => htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8'),
                    'zipcode' => intval($_POST['zipcode']),
                    'town' => htmlspecialchars($_POST['town'], ENT_QUOTES, 'UTF-8'),
                    'birth' => date('Y-m-d', strtotime($_POST['birth'])),
                    'phone' => htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8'),
                    'formation' => htmlspecialchars($_POST['formation'], ENT_QUOTES, 'UTF-8'),
                    'filename' => $profile_pic
                    ));
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">';
        die('Error:'.$e->getMessage());
        echo '</div>';
    }
}

?>
