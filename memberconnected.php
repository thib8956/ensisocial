<?php
try {
		$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die('Error:'.$e->getMessage());
	}

$memberconnected=$db-> query('SELECT lastname,firstname,connected from users ');
while($donne = $memberconnected->fetch()){
	$firstname = htmlentities($donne['firstname']);
	$lastname=htmlentities($donne['lastname']);
	if( htmlentities($donne['connected'])){
		echo '<p><span class="glyphicon glyphicon-record" style="color:#58D68D"></span> '.$firstname.' '.$lastname.' <br /></p>';
	}
	else{
		echo '<p><span class="glyphicon glyphicon-record" style="color:#D7DBDD"></span> '.$firstname.' '.$lastname.' <br /></p>';
	}
}
?>