

<?php
$title="Groupe";
session_start();
if (session_status() != 2){
	echo '<p>Erreur : session non démarrée</p>';
	header('/ensisocial/index.php');
}
$id=(isset($_GET["id"])) ? $_GET["id"] : NULL;
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
	$member=$db->prepare('SELECT iduser FROM member WHERE idgroup=:id');
	$member->execute(array('id'=>$id));
	$idmember=array();
	while($memb=$member->fetch()){
		array_push($idmember, $memb['iduser']);
	}

	if(!in_array($_SESSION['id'], $idmember)){
		header('location:/ensisocial/group/group.php');
	}
	$stmt = $db->prepare('SELECT *
		FROM newsfeed
		JOIN authornews ON newsfeed.id = authornews.newsfeedid
		JOIN users ON users.id = authornews.authorid
		WHERE type=1
		AND place=:id');
	$stmt->execute(array('id'=>$id));

	$group=$db->query('SELECT * from groupe WHERE id='.$_GET['id']);
	$data=$group->fetch();


	/* Fetch profile picture */
	if (!empty($data['img'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['img'];
	} else {
		$pic_path = '/ensisocial/data/avatar/default-group.png';
	}
} catch (PDOException $e) {
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}


$user=$data;
$user["FORMATIONS"]=$FORMATIONS;

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');

?>


<!-- Add a publication -->
<div class="row">
	<div class="col-sm-offset-3 col-md-6">

		<form action="/ensisocial/publication.php" method="post" accept-charset="UTF-8">
			<?php
			$form = new Form($_POST, 'post');
			echo $form->inputfield('title', 'text', 'Titre de la publication');
			echo $form->inputtextarea('content', 'Contenu', 5, 16);
			echo $form->submit('Publier');
			echo '<input type="hidden" name="idplace" class="btn btn-primary-outline" value="'.$_GET['id'].'" />';
			echo '<input type="hidden" name="type" class="btn btn-primary-outline" value="1" />
		</form>';
		?>


	</div>
</div>
<!-- Display newsfeed -->
<div class="newsfeedwrap">
	<div class="col-sm-offset-3 col-md-6 newsfeed">
		<?php
		$commId=0;
		while ($publication=$stmt->fetch()){
			$vote=$db->prepare('SELECT iduser,vote FROM vote where idnews=:idnews and iduser=:iduser');
			$vote->execute(array(
				'idnews'=>$publication['newsfeedid'],
				'iduser'=>$_SESSION['id']));
			$vote=$vote->fetch();
			$place= $db->prepare('SELECT * FROM groupe WHERE groupe.id=:id');
			$place->execute(array('id'=>intval($publication['place'])));
			$loc=$place->fetch();
			$commId+=1;
			$avatar = '/ensisocial/data/avatar/'.$publication['profile_pic'];

			if(!isset($_SESSION['commentUnfold'][$publication['newsfeedid']])) { //creation de la limite de commentaire
				$_SESSION['commentUnfold'][$publication['newsfeedid']]=5;
			}

			?>
			<div class="panel panel-default" >
				<?php
				$score = $publication['score'];
				?>
				<div class="panel-heading" >
					<a class="pull-left" href="#">
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
					</a>

					<?php if ($_SESSION['id'] == $publication['authorid']): ?>
						<a class="btn btn-default pull-right" href=<?php echo '"/ensisocial/delete.php?id='.$publication['newsfeedid'].'"'; ?>>
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							Supprimer
						</a>
					<?php endif?>
					<?php
					$score = $publication['score'];
					if(array_key_exists($loc['name'], $FORMATIONS)){
						echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
						<small>
							<span class="glyphicon glyphicon-chevron-right">
							</span>
							<a href="/ensisocial/group/groupPage.php?id='.$loc['id'].'">'.$FORMATIONS[$loc['name']].'
							</a>
						</small>
					</h2>';
				}else{
					echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
					<small>
						<span class="glyphicon glyphicon-chevron-right">
						</span>
						<a href="/ensisocial/group/groupPage.php?id='.$loc['id'].'">'.$loc['name'].'
						</a>
					</small>
				</h2>';
			}
			echo '<h3>'.$publication['title'].'</h3>';
			?>
		</div> <!-- .panel-heading -->

		<div class="panel-body">
			<?php
			include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/checklink.php');
			checkLink($publication['content']);
			if($score >= 0){
				echo '<span class="score" style="color:#00DD00">'.$score.'</span>&nbsp;&nbsp;';
			} else {
				echo '<span class="score" style="color:#DD0000">'.$score.'</span>&nbsp;&nbsp;';
			}

			if((!empty($vote['iduser'])) and $vote['vote']==1){ // si c'est poce bleu c'est vert
				echo '<button  class="glyphicon glyphicon-thumbs-up btn btn-link thumb" onclick=clicup('.$publication['newsfeedid'].','.$_SESSION['id'].') style="color:#00DD00" ></button>&nbsp;&nbsp;';
				echo '<button  class="glyphicon glyphicon-thumbs-down btn btn-link thumb" onclick=clicdown('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>';

            }elseif((!empty($vote['iduser'])) and $vote['vote']==0){// si c'est pas poce bleu c'est rouge
            	echo '<button  class="glyphicon glyphicon-thumbs-up btn btn-link thumb" onclick=clicup('.$publication['newsfeedid'].','.$_SESSION['id'].')  ></button>&nbsp;&nbsp;';
            	echo '<button  class="glyphicon glyphicon-thumbs-down btn btn-link thumb" onclick=clicdown('.$publication['newsfeedid'].','.$_SESSION['id'].') style="color:#DD0000" ></button>';

            }else{ // si c'est rien c'est rien
            	echo '<button  class="glyphicon glyphicon-thumbs-up btn btn-link thumb" onclick=clicup('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>&nbsp;&nbsp;';
            	echo '<button  class="glyphicon glyphicon-thumbs-down btn btn-link thumb" onclick=clicdown('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>';
            }
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
					<?php echo '<input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">' ?>
					<?php echo '<input name="post_id" type="hidden" value='.$publication['newsfeedid'].'>' ?>
				</form>
				<p>
					<?php if($nbrDisplayComment != $nbrTotalComment) { ?>
					<a class="btn btn-default showMore" href=<?php echo "/ensisocial/php/commentUnfold.php?id=".$publication['newsfeedid'].'>Voir plus de commentaires  ('.$nbrDisplayComment.'/'.$nbrTotalComment.') </a>' ?>
					<?php } ?>
					<?php if($_SESSION['commentUnfold'][$publication['newsfeedid']]!=5) { ?>
					<a class="btn btn-default showLess" href=<?php echo "/ensisocial/php/commentfold.php?id=".$publication['newsfeedid']; ?>> Réduire les commentaires </a>
					<?php } ?>
				</p>
			</div>
		</div> <!-- /.panel-body -->
		<
	</div> <!-- /.panel -->

	<?php
		} // /while

		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		
		echo '</div>'; /* /.newsfeed */
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/group/groupemember.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/messagerie/chatBox.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>
