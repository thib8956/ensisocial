<?php
$title="Inscription";
include('header.php');


if(isset($_POST['signin']) && $_POST["signin"]="signin"){
	if (!empty($_POST['username']) &&
		!empty($_POST['password'])){
		if($_POST["password"] == $_POST["repassword"]){
			echo '<p>Victoire !!</p>';
			fillDatabase($db);
			
		}else{
			echo "t'es beau, tu vas y arriver, persévères !";
		}
	}



}
else{
		echo"courage";
	}

function fillDatabase($connection) {
	echo 'INSERT INTO users VALUES ("'
						.mysql_escape_string($_POST['username']).'","' 
						.mysql_escape_string($_POST["password"]).'","'
						.mysql_escape_string($_POST['firstname']).'","'
						.mysql_escape_string($_POST['secondname']).'","'
						.mysql_escape_string($_POST['lastname']).'","'
						.mysql_escape_string($_POST['address']).'","'
						.mysql_escape_string($_POST['zipcode']).'","' 
						.mysql_escape_string($_POST['town']).'","'
						.mysql_escape_string($_POST['birth']).'","'
						.mysql_escape_string($_POST['email']).'","'
						.mysql_escape_string($_POST['phone']).'","'
						.mysql_escape_string($_POST['formation']).'");' ;
	$req = $connection->prepare('INSERT INTO users VALUES ("'
						.mysql_escape_string($_POST['username']).'","' 
						.mysql_escape_string($_POST["password"]).'","'
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
