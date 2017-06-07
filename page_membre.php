<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
    session_start();
}
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title = $_SESSION['firstname'];
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');


try {
	$stmt = $db->query('SELECT *
		FROM newsfeed
		JOIN authornews ON newsfeed.id = authornews.newsfeedid
		JOIN users ON users.id = authornews.authorid
		ORDER BY date DESC'
		);
	$score = 42;

	/* Fetch profile picture */
	$profile  = $db->query('SELECT profile_pic from users WHERE id='.$_SESSION['id']);
	$data = $profile->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = 'data/default-profile.png';
	}

} catch (PDOException $e) {
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}
?>

<!-- Left panel -->
<div class="row">
	<div class="col-sm-2 well affix">
		<center>
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" class="img-circle img-responsive"></a>
			<h3>
				<?php
				echo $_SESSION['firstname'].' '.$_SESSION['lastname'];
				?>
			</h3>
		</center>
		<!-- List of connected members. -->
		<p>Autres membres : </p>
		<div id="memberconnected">Membres</div>
	</div>
</div>

<!-- Pop up lorsque l'on clique sur l'image-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="profil" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn btn-danger btn-lg" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
			<div class="modal-body">
				<center>
					<img class="img-circle" src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" border="0">
					<h3 class="media-heading"><?php echo $_SESSION['firstname'].' ';echo$_SESSION['lastname'].' ' ?><small><?php echo $_SESSION['town'] ?></small></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>Formation: </strong> <?php  echo $_SESSION['formation'] ?></p>
					<p class="text-left"><strong>Né le : </strong> <?php  echo date('d-m-Y', strtotime($_SESSION['birth'])); ?></p>
				</center>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</center>
			</div>
		</div>
	</div>
</div>

<!-- Add a publication -->
<div class="row">
	<div class="col-sm-offset-2 col-md-9">
			<form action="publication.php" method="post">
				<?php
				$form = new Form($_POST, 'post');
				echo $form->inputfield('title', 'text', 'Titre de la publication');
				echo $form->inputtextarea('content', 'Contenu', 5, 16);
				echo $form->submit('Publier');
				?>
			</form>
	</div>
</div>
<!-- Display newsfeed -->
<div class="col-sm-offset-2 col-md-9">
	<?php
	while ($publication=$stmt->fetch()){
		$avatar = '/ensisocial/data/avatar/'.$publication['profile_pic'];
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="pull-left" href="#">
					<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
				</a>
				<?php
				echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'</h2>';
				echo '<h3>'.$publication['title'].'</h3>';
				?>
			</div> <!-- .panel-heading -->
			<div class="panel-body">
				<?php
				echo '<p>'.$publication['content'].'</p>';
				echo '<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;'.$score.'&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-down"></span>';
				echo '<p class="text-right small">'.$publication['date'].'</p>';
					// Comment section
				echo '<ul class="list-group">';
					include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/comment.php'); // include à répétition donc ne pas mettre include_once
					echo '</ul>';
					?>
					<!-- Add a comment -->
					<div class="input-group">
						<form action="/ensisocial/comment_submit.php" method="post" accept-charset="utf-8">
							<input class="form-control" placeholder="Ajouter votre commentaire" type="text" name="add">
							<?php echo '<input type="hidden" name="back" value='.$_SERVER['REQUEST_URI'].'>' ?>
							<?php echo '<input name="post_id" type="hidden" value='.$publication['newsfeedid'].'>' ?>
						</form>
						<a href=<?php echo "delete.php?id=".$publication['newsfeedid']; ?>>delete </a>
					</div>
				</div> <!-- /.panel-body -->
			</div> <!-- /.panel -->
		<?php
		} // /while
		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>
