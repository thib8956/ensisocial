<?php
$thumbup=$db->prepare('UPDATE `newsfeed` 
	SET `upvote` = `upvote`+1 WHERE `newsfeed`.`id` =:id ;');
function thumbup($id){
	$thumbup->execute(array('id'=>$id));
}
thumbup($publication['newsfeedid']);
?>