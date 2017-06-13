<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
session_start();
}
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8mb4", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$memberconnected = $db-> query('SELECT lastname, firstname, connectedTime FROM users');

    if(isset($_SESSION['id'])) {
        $connectionRefresh = $db->prepare('UPDATE users SET connectedTime = :time WHERE id = :id');
        $connectionRefresh->execute(array('time' => time(),'id' => $_SESSION['id']));
    }
} catch (PDOException $e) {
	die('Error:'.$e->getMessage());
}
echo '<ul class="list-group">';
while($data = $memberconnected->fetch()){
	$firstname = $data['firstname'];
	$lastname = $data['lastname'];

	if (htmlentities($data['connectedTime']) > time() - 11){
		echo '<li class="list-group-item">';
		echo '<span class="glyphicon glyphicon-record" style="color:#58D68D"></span>';
		echo ' '.$firstname.' '.$lastname;
		echo '</li>';
	}
}
echo '</ul>';
?>
