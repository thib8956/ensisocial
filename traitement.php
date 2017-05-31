<?php
$title="Inscription";
include('header.php');
$reponse = $db->query('SELECT username FROM users');

if(isset($_POST['signin']))
{
	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty('$_POST'))
    {
        while (true)
        {
            while($donnees = $reponse->fetch())
            {
                if ($_POST['username'] == $donnees['username'])
                {
                    echo "<p>Username déjà utilisé</p>";
                    break(2);
                }
            }
            if($_POST["password"] == $_POST["repassword"])
            {
                echo '<p>Mot de passe OK</p>';
                fillDatabase($db);
                echo '<p>Vous êtes bien inscrit</p>';
            }
            else
            {
                echo "Vos 2 mots de passe ne sont pas similaires.";
            }
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
