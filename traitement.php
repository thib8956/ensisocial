<?php
include('header.php');

if(isset($_POST['signin']) && $_POST['signin'] = 'signin'){
	if (isset($_POST['username']) &&
		isset($_POST['password'])){
		if($_POST["password"] == $_POST["repassword"]){
			echo '<p>Victoire !!</p>';
			fillDatabase($db);
			
		}else{
			echo "t'es beau, tu vas y arriver, persévères !";
		}
	}


}

function fillDatabase($connection) {
	$req = $connection->prepare('INSERT INTO users VALUES ("'
						.mysql_escape_string($_POST['username']).'","' 
						.mysql_escape_string($_POST['firstname']).'","'
						.mysql_escape_string($_POST['secondname']).'","'
						.mysql_escape_string($_POST['lastname']).'","'
						.mysql_escape_string($_POST['address']).'","'
						.'NULL","' /* Code postal */
						.'NULL","' /* Ville */
						.mysql_escape_string($_POST['birth']).'","'
						.mysql_escape_string($_POST['email']).'","'
						.mysql_escape_string($_POST['phone']).'","'
						.mysql_escape_string($_POST['password']).'");' /* Mot de passe en clair LOLZ */
						);
	$req->execute();
}
?>
