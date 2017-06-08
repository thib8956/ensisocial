<?php
session_start();
$title="Recherche";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
	$profil  = $db->query('SELECT * from users WHERE id='.$_GET['id']);
	$profilDonnee = $profil->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = '/ensisocial/data/avatar/default-profile.png';
	}
	$stmt = $db->query('
		SELECT *
		FROM newsfeed
		JOIN authornews ON newsfeed.id = authornews.newsfeedid
		JOIN users ON users.id = authornews.authorid
		WHERE place='.$_GET['id'].'
		ORDER BY date DESC'
		);

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
				echo $profilDonnee['firstname'].' '.$profilDonnee['lastname'];
				?>
			</h3>
		</center>
		<?php if ($profilDonnee['id'] == $_SESSION['id']): ?>
			<p><a class="btn btn-default" href="/ensisocial/edit-profile.php">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Modifier mes informations
			</a></p>
		<?php endif ?>
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
					<h3 class="media-heading"><?php echo $profilDonnee['firstname'].' '; echo$profilDonnee['lastname'].' ' ?><small><?php echo $profilDonnee['town'] ?></small></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>Formation: </strong> <?php  echo $profilDonnee['formation'] ?></p>
					<p class="text-left"><strong>Né le : </strong> <?php  echo date('d-m-Y', strtotime($profilDonnee['birth'])); ?></p>
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

		<form action="/ensisocial/publication.php" method="post">
			<?php
			$form = new Form($_POST, 'post');
			echo $form->inputfield('title', 'text', 'Titre de la publication');
			echo $form->inputtextarea('content', 'Contenu', 5, 16);
			echo $form->submit('Publier');
			echo '<input type="hidden" name="idplace" class="btn btn-primary-outline" value="'.$_GET['id'].'" />
		</form>';
		?>


	</div>
</div>

<!-- Display newsfeed -->
<div class="newsfeedwrap">
	<div class="col-sm-offset-2 col-md-9 newsfeed">
		<?php
		$commId=0;
		while ($publication=$stmt->fetch()){
			$place= $db->prepare('SELECT * FROM users WHERE users.id=:id');
			$place->execute(array('id'=>intval($publication['place'])));
			$loc=$place->fetch();
			$commId+=1;
			$avatar = '/ensisocial/data/avatar/'.$publication['profile_pic'];
			?>
			<div class="panel panel-default" id="publi">
				<?php
				$score = $publication['score'];
				?>
				<div class="panel-heading" id="page_membre">
					<a class="pull-left" href="#">
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
					</a>

					<?php if ($_SESSION['id'] == $publication['authorid']): ?>
						<a class="btn btn-default pull-right" href=<?php echo '/ensisocial/delete.php?id='.$publication['newsfeedid']; ?>>
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							Supprimer
						</a>
					<?php endif?>
					<?php
					$score = $publication['score'];
					echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
					<small>
						<span class="glyphicon glyphicon-chevron-right">
						</span>
						<a href="/ensisocial/recherche/searchProfil.php?id='.$loc['id'].'">'.$loc['firstname'].' '.$loc['lastname'].'
						</a>
					</small>
				</h2>';
				echo '<h3>'.$publication['title'].'</h3>';
				?>
			</div> <!-- .panel-heading -->

			<div class="panel-body">
				<?php
				echo '<p>'.$publication['content'].'</p>';
				if($score >= 0){
					echo '<span class="score" style="color:#00DD00">'.$score.'</span>&nbsp;&nbsp;';
				} else {
					echo '<span class="score" style="color:#DD0000">'.$score.'</span>&nbsp;&nbsp;';
				}

				echo '<button  class="glyphicon glyphicon-thumbs-up btn btn-link" onclick=clicup('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>&nbsp;&nbsp;';
				echo '<button  class="glyphicon glyphicon-thumbs-down btn btn-link" onclick=clicdown('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>';
				echo '<p class="text-right small">'.$publication['date'].'</p>';
				// Comment section
				echo '<ul class="list-group">';
				include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/comment.php'); // include à répétition donc ne pas mettre include_once
				echo '</ul>';
				?>
				<!-- Add a comment -->
				<div class="input-group">
					<?php echo '<form id="comm'.$commId.'" class="submitAjax" action="/ensisocial/comment_submit.php" method="post" accept-charset="utf-8">' ?>
					<input class="form-control" placeholder="Ajouter votre commentaire" type="text" name="add" autocomplete="off">
					<?php echo '<input type="hidden" name="back" value='.$_SERVER['REQUEST_URI'].'>' ?>
					<?php echo '<input name="post_id" type="hidden" value='.$publication['newsfeedid'].'>' ?>
				</form>
			</div>
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel -->
	<?php
		} // /while
		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		echo '</div>'; /* /.newsfeed */
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>

