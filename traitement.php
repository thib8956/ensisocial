<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/upload.php');

$answer = $db->query('SELECT email FROM users');

// Récupération d'inscription puis découpe avec substr
$start = 0;
$string = get_include_contents('inscription.php');
$utile = substr ($string, $start);

if(isset($_POST['signin'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
        $mailUsed = false;
        while($data = $answer->fetch()) {
            if ($_POST['email'] == $data['email']){
                echo '<div class="alert alert-danger">';
                echo "<p>Adresse mail déjà utilisée.</p>";
                echo '</div>';
                echo $utile;
                $mailUsed = true;
                exit;
            }
        }
        if (!$mailUsed){
            if($_POST["password"] == $_POST["repassword"]){
                
                if (!empty($_POST["zipcode"]) && !preg_match("#[0-9]{5}#",$_POST["zipcode"])) {
                    echo '<div class="alert alert-danger"><p>Veuillez entrer un code postal de 5 chiffres</p></div>';
                    echo $utile;
                    exit;
                }
                if (!empty($_POST["phone"]) && !preg_match("#0[0-9]{9}#",$_POST["phone"])) {
                    echo '<div class="alert alert-danger"><p>Merci de mettre un numéro de téléphone de 10 chiffres (pas de +XX)</p></div>';
                    echo $utile;
                    exit;
                }
                if (!empty($_POST["birth"]) && !preg_match("#[0-9]{2}/[0-9]{2}/[0-9]{4}#",$_POST["birth"])) {
                    echo '<div class="alert alert-danger"><p>Merci de mettre une date de naissance de ce format JJ/MM/AAAA</p></div>';
                    echo $utile;
                    exit;
                }
                if (strlen($_POST["password"])<6){
                    echo '<div class="alert alert-danger"><p>Mot de passe trop court</p></div>';
                    echo $utile;
                    exit;
                }
                if (!empty($_FILES['picture']['name'])){
                    // Generate an unique filename for the profile pic.
                    $fname = md5(uniqid(rand(), true));
                    $ext = '.'.substr(strrchr($_FILES['picture']['name'], '.'), 1); // Get file extension
                    $fname .= $ext;
                    $dst = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/avatar/'.$fname;

                    // Upload profile picture
                    upload('picture', $dst);
                } else {
                    $fname = 'default-profile.png';
                }
                fillDatabase($db, $fname);

                //Envoi du mail
                //mail($to, $objet, $contenu, $headers);
                echo '<p>Vous êtes bien inscrit. Allez voir vos mails ;)</p>';
                exit;
            } else {
                echo '<div class="alert alert-danger">';
                echo "Vos 2 mots de passe ne sont pas identiques.";
                echo '</div>';
                echo $utile;
                exit;
            }
        } else {
            "<div class='alert alert-danger'>Cette adresse est déjà utilisée</div>";
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
            'INSERT INTO users (`email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `profile_pic`)
            VALUES (:email, :password, :firstname, :lastname, :address, :zipcode, :town, :birth, :phone, :formation, :filename)'
            );
        $stmt->execute(array(
                    'email' => $_POST['email'],
                    'password' => $hash, // Mot de passe hashé avec bcrypt
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'address' => htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8'),
                    'zipcode' => htmlspecialchars($_POST['zipcode'], ENT_QUOTES, 'UTF-8'),
                    'town' => htmlspecialchars($_POST['town'], ENT_QUOTES, 'UTF-8'),
                    'birth' => date('Y-m-d', strtotime($_POST['birth'])),
                    'phone' => htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8'),
                    'formation' => htmlspecialchars($_POST['formation'], ENT_QUOTES, 'UTF-8'),
                    'filename' => $profile_pic
                    ));

        $stmt=$connection->prepare('SELECT id from users WHERE email=:email');
        $stmt->execute(array(
            'email'=>$_POST['email']));
        $iduser=$stmt->fetch();

        $stmt=$connection->prepare('SELECT id from groupe WHERE name=:name');
        $stmt->execute(array(
            'name'=>$_POST['formation']));
        $idgroup=$stmt->fetch();

        $stmt=$connection->prepare('INSERT INTO member(`iduser`, `idgroup`) VALUES(:iduser, :idgroup)');
        $stmt->execute(array(
            'iduser'=>$iduser['id'],
            'idgroup'=> $idgroup['id']));
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">';
        die('Error:'.$e->getMessage());
        echo '</div>';
    }
}

/**
 * [get_include_contents description]
 * @param  [type] $filename [description]
 * @return [type]           [description]
 */
function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}
?>
