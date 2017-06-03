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


if(isset($_POST['signin']))
{
    if (empty($_POST['firstname']))
    {
        echo '<div class="alert alert-danger">';
        echo "<p>Veuillez insérer un prénom.</p>";
        echo '</div>';
        echo $utile;
        exit;
     }
    if (empty($_POST['lastname']))
    {
        echo '<div class="alert alert-danger">';
        echo "<p>Veuillez insérer un nom.</p>";
        echo '</div>';
        echo $utile;
        exit;
    }
	if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname']))
    {
        while($data = $answer->fetch())
        {
            if ($_POST['email'] == $data['email'])
            {
                echo '<div class="alert alert-danger">';
                echo "<p>Adresse mail déjà utilisée.</p>";
                echo '</div>';
                echo $utile;
                exit;
            }
        }
        if($_POST["password"] == $_POST["repassword"])
        {
            echo '<p>Mot de passe OK.</p>';
            fillDatabase($db);
            echo '<p>Vous êtes bien inscrit.</p>';
            exit;
        }
        else
        {
            echo '<div class="alert alert-danger">';
            echo "Vos 2 mots de passe ne sont pas similaires.";
            echo '</div>';
            echo $utile;
            exit;
        }
    }
}

function fillDatabase($connection) {
	/* Chiffrement du mot de passe.*/
	$options = [
          'cost' => 11
        ];
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

    try {
        $stmt = $connection->prepare('INSERT INTO users VALUES (NULL, :email, :password, :firstname, :lastname, :address, :zipcode, :town, :birth, :phone, :formation, FALSE)');
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
                    'formation' => htmlspecialchars($_POST['formation'], ENT_QUOTES, 'UTF-8')
                    ));
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">';
        die('Error:'.$e->getMessage());
        echo '</div>';
    }
}

?>
