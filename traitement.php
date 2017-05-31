<?php
$title="Inscription";
include('header.php');
$answer = $db->query('SELECT username FROM users');
$start = 516;
$string = get_include_contents('inscription.php');
$utile = substr ($string,$start);
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
	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty('$_POST'))
    {
        while($data = $answer->fetch())
        {
            if ($_POST['username'] == $data['username'])
            {
                echo '<div class="alert alert-danger">';
                echo "<p>Username déjà utilisé</p>";
                echo '</div>';
                echo $utile;
                exit;
            }
        }
        if($_POST["password"] == $_POST["repassword"])
        {
            echo '<p>Mot de passe OK</p>';
            fillDatabase($db);
            echo '<p>Vous êtes bien inscrit</p>';
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
        $stmt = $connection->prepare('INSERT INTO users VALUES (:username, :password, :firstname, :secondname, :lastname, :address, :zipcode, :town, :birth, :email, :phone, :formation)');
        $stmt->execute(array('username' => $_POST['username'],
                    'password' => $hash, // Mot de passe hashé avec bcrypt
                    'firstname' => $_POST['firstname'],
                    'secondname' => $_POST['secondname'],
                    'lastname' => $_POST['lastname'],
                    'address' => $_POST['address'],
                    'zipcode' => intval($_POST['zipcode']),
                    'town' => $_POST['town'],
                    'birth' => date('Y-m-d', strtotime($_POST['birth'])),
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'formation' => $_POST['formation']));
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">';
        die('Error:'.$e->getMessage());
        echo '</div>';
    }
}

?>
