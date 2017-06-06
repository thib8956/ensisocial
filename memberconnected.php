<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$memberconnected = $db-> query('SELECT lastname, firstname, connected FROM users');
} catch (PDOException $e) {
	die('Error:'.$e->getMessage());
}

echo '<ul class="list-group">';
while($data = $memberconnected->fetch()){
	$firstname = htmlentities($data['firstname']);
	$lastname = htmlentities($data['lastname']);

	echo '<li class="list-group-item">';
	if (htmlentities($data['connected'])){
		echo '<span class="glyphicon glyphicon-record" style="color:#58D68D"></span>';
	} else {
		echo '<span class="glyphicon glyphicon-record" style="color:#D7DBDD"></span>';
	}
	echo ' '.$firstname.' '.$lastname;
	echo '</li>';
}

echo '</ul>';
?>
