<?php


$thumbdown=$db->prepare('UPDATE `newsfeed` 
	SET `downvote` = `downvote`+1 WHERE `newsfeed`.`id` =:id ;');



function thumbdown($d){
	$thumbdown->execute(array('id'=>$id));
}

thumbdown($publication['newsfeedid']);
?>
