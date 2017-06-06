<?php
$title="Inscription";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

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

if(isset($_POST['signin'])) {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
        while($data = $answer->fetch()) {
            if ($_POST['email'] == $data['email']){
                echo '<div class="alert alert-danger">';
                echo "<p>Adresse mail déjà utilisée.</p>";
                echo '</div>';
                echo $utile;
                exit;
            }
            if($_POST["password"] == $_POST["repassword"]){
                echo '<p>Mot de passe OK.</p>';
                // Generate an unique filename for the profile pic.
                $fname = md5($_FILES['picture']['name']);
                $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1); // Get file extension
                $dst = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/avatar/'.$fname.$ext;
                // Upload profile picture
                upload('picture', $dst);
                fillDatabase($db, $fname);
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

/**
 * Upload a profile picture to the server.
 * @param  string  $index       Name of the input field : $_FILES[$index]
 * @param  string  $destination Destination path.
 * All profile pictures are stored in /ensisocial/data/avatars
 */
function upload($index, $destination, $maxsize=FALSE, $extensions=FALSE){
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    // Test max file size
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    // Check whether the file has a valid extension.
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    $ret = move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
    print_errors($ret);
    return $ret;
}


/**
 * Print error messages according to move_upload_file() return codes.
 * cf. http://www.php.net/manual/en/features.file-upload.errors.php
 * @param  int $retcode return code of move_upload_file().
 */
function print_errors($retcode){
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );
    if ($retcode > 0){
        echo '<div class="alert alert-danger">';
        echo $phpFileUploadErrors[$retcode];
        echo '</div>';
    }
}
?>
