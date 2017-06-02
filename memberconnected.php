<?php
include_once('inc/header.php');

$memberconnected = $db-> query('SELECT lastname, firstname, connected FROM users');
while($data = $memberconnected->fetch()){
	$firstname = htmlentities($data['firstname']);
	$lastname = htmlentities($data['lastname']);
	if(htmlentities($data['connected'])){
		echo '<p><span class="glyphicon glyphicon-record" style="color:#58D68D"></span> '.$firstname.' '.$lastname.' <br /></p>';
	}
	else{
		echo '<p><span class="glyphicon glyphicon-record" style="color:#D7DBDD"></span> '.$firstname.' '.$lastname.' <br /></p>';
	}
}

include_once('inc/footer.php');
?>
