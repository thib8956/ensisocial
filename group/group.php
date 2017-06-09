<?php
$title="Groupe";
session_start();
if (session_status() != 2){
	echo '<p>Erreur : session non démarrée</p>';
	header('/ensisocial/index.php');
}
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
	$stmt = $db->query('SELECT *
		FROM newsfeed
		JOIN authornews ON newsfeed.id = authornews.newsfeedid
		JOIN users ON users.id = authornews.authorid
		ORDER BY date DESC'
		);
	$group=$db->query('SELECT * 
		FROM groupe');

	/* Fetch profile picture */
	$profile  = $db->query('SELECT profile_pic from users WHERE id='.$_SESSION['id']);
	$data = $profile->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = '/ensisocial/data/avatar/default-group.png';
	}
} catch (PDOException $e) {
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}


include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');
?>

<div class="groupwrap">
	<div class="col-sm-offset-2 col-md-9">
		<?php
		while ($row=$group->fetch()){
			$avatar = '/ensisocial/data/avatar/'.$row['img'];
			?>
			<div class="panel-heading" id="group">
				<a class="pull-left" href="#">
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
					</a>
			<?php
			echo '<h2>'.$row['name'].'</h2>'
		
		?>
		</div> <!-- panel-heading-->

		<div class ="panel-body">
		<?php
		echo '<p>'.$row['description'].'</p>
				</div>';
	}
		?>
	</div> <!-- col-sm-offset-2 col-md-9  -->
</div> <!--groupwrap -->




<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>