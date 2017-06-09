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
		FROM groupe 
		ORDER BY name');
	$user = $_SESSION;

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

<div class="groupswrap">
	<div class="col-sm-offset-3 col-md-8 newsfeed">
	<?php
	while ($row=$group->fetch()){
		$avatar = '/ensisocial/data/avatar/'.$row['img'];
		?>
		<div class="panel panel-default" id="group">
			<div class="panel-heading clearfix">
					<a class="pull-left" href="#">
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
					</a>
					<h2>
						<?php echo $row['name'] ?>
						<a class="btn btn-link" data-toggle="collapse" data-target=<?php echo '#'.$row['id'] ?> aria-expanded="false">
							<span class="glyphicon glyphicon-option-horizontal"></span>
						</a>
					</h2>	 
			</div>

			<div class="panel-body " id=<?php echo $row['id']; ?>>
				<div>
				<?php
				echo '<p>'.$row['description'].'</p>';?>
				</div>
			</div><!--panel-body -->
		</div><!--panel panel-default-->
		<?php
		} // while
		?>
	</div><!--col-sm-offset-3 col-md-8 newsfeed-->
</div><!--groupwrap-->



<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>