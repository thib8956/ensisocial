<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

$compt= (isset($_POST["num"])) ? $_POST["num"] : NULL ;
$action =(isset($_POST["action"])) ? $_POST["action"] : NULL ;


function thumb($id,$action,$conn){
	if($action== 1){
		$thumbdown=$conn->prepare('UPDATE `newsfeed` 
			SET `downvote` = `downvote`+1 WHERE `id` =:id ;');
		$thumbdown->execute(array('id'=>$id));
	} else{
		$thumbup=$conn->prepare('UPDATE `newsfeed` 
			SET `upvote` = `upvote`+1 WHERE `id` =:id ;');

		$thumbup->execute(array('id'=>$id));
	}
}

thumb($compt,$action,$db);
?>