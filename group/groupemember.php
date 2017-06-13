<?php


$groupmember=$db->prepare('SELECT `users`.`id`,`firstname`,`lastname`,`users`.`profile_pic` FROM `users` join `member` on `member`.`iduser`=`users`.`id` join `groupe` on `member`.`idgroup`=`groupe`.`id` where `groupe`.`id`=:groupid');
$groupmember->execute (array(
	'groupid'=>$id))
?>
<div class="col-md-3 col-md-offset-9 col-sm-6 affix hidden-print hidden-sm hidden-xs" id="rightbar">
<ul class="list-group " >

	<?php
	while($member=$groupmember->fetch()){
	$avatar = '/ensisocial/data/avatar/'.$member['profile_pic'];
	?>
		<li class="list-group-item">
				<a class="pull-left" href=<?php echo ' "/ensisocial/recherche/searchProfil.php?id='.$member['id'].'"'?>>
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 60px;">
				</a>
				<?php echo '<h2><strong>'.$member['firstname'].' '.$member['lastname'].'</strong></h2>';?>
		</li>
		
	<?php	
	}
	?>
</ul>
</div>