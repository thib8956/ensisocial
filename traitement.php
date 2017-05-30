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

	$req = $connection->prepare('INSERT INTO users VALUES ("'
						.mysql_escape_string($_POST['username']).'","' 
						.mysql_escape_string($hash).'","' /* Mot de passe hashé avec bcrypt. */
						.mysql_escape_string($_POST['firstname']).'","'
						.mysql_escape_string($_POST['secondname']).'","'
						.mysql_escape_string($_POST['lastname']).'","'
						.mysql_escape_string($_POST['address']).'","'
						.mysql_escape_string($_POST['zipcode']).'","' 
						.mysql_escape_string($_POST['town']).'","'
						.mysql_escape_string($_POST['birth']).'","'
						.mysql_escape_string($_POST['email']).'","'
						.mysql_escape_string($_POST['phone']).'","'
						.mysql_escape_string($_POST['formation']).'");' 
						);
	$req->execute();
}
?>
