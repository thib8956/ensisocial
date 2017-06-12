<?php
session_start();
$title="Recherche";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
	$profil  = $db->query('SELECT * from users WHERE id='.$_GET['id']);
	$data = $profil->fetch();
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
// Sidebar
$user = $data;
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');
?>
<!-- Add a publication -->
<div class="row">
	<div class="col-sm-offset-3 col-md-8">

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
	<div class="col-sm-offset-3 col-md-8 newsfeed">
		<?php
		$commId=0;
		while ($publication=$stmt->fetch()){
			$place= $db->prepare('SELECT * FROM users WHERE users.id=:id');
			$place->execute(array('id'=>intval($publication['place'])));
			$loc=$place->fetch();
			$commId+=1;
			$avatar = '/ensisocial/data/avatar/'.$publication['profile_pic'];

			if(!isset($_SESSION['commentUnfold'][$publication['newsfeedid']])) { //creation de la limite de commentaire
			                $_SESSION['commentUnfold'][$publication['newsfeedid']]=5;
			            }

			?>
			<div class="panel panel-default" id="publi">
				<?php
				$score = $publication['score'];
				?>
				<div class="panel-heading" id="page_membre">
					<a class="pull-left" href=<?php
					echo '"/ensisocial/recherche/searchProfil.php?id='
					.$publication['authorid'].'"';
					?>>
						<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
					</a>

					<?php if ($_SESSION['id'] == $publication['authorid']): ?>
						<a class="btn btn-default pull-right supprNews" href=<?php echo '/ensisocial/delete.php?id='.$publication['newsfeedid']; ?> >
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
				if (preg_match("#https?://www\.youtube\.com/watch\?v=#i",$publication['content'])) {
                $beginning = strpos($publication['content'], "https://www.youtube.com/watch?v=");
                $end = 43;
                $url1 = substr($publication['content'], $beginning, $end);
                $publication['content'] = preg_replace("#https?://www\.youtube\.com/watch\?v=.{11}#i", "", $publication['content']);
                $urlbien = substr_replace($url1,"embed/",24,8);
                echo "<p>".$publication['content']."</p>";
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo '<p><video src='.$urlbien.' controls></video></p>';
                echo "</div>";
            }
            if (preg_match("#https?://www\.dailymotion\.com/video/.{7}#i",$publication['content'])) {
                $beginning = strpos($publication['content'], "http://www.dailymotion.com/video/");
                $end = 40;
                $url = substr($publication['content'], $beginning, $end);
                $urlbien = preg_replace("#https?://www\.dailymotion\.com/video/#i", "http://www.dailymotion.com/embed/video/", $url);
                $publication['content'] = preg_replace("#https?://www\.dailymotion\.com/video/.{7}#i", "", $publication['content']);
                echo "<p>".$publication['content']."</p>";
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo '<p><iframe src='.$urlbien.' allowfullscreen></iframe>';
                echo "</div>";
            }
            if (preg_match("#/media/.+\.(jpe?g|gif|bmp|png)#i",$publication['content'])) {
				$beginning = strpos($publication['content'], "/media/");
                $end = 39;
                $url1 = substr($publication['content'], $beginning, $end);
                $exp = substr($publication['content'], $beginning, $end+5);
                $expbien = preg_replace("# #","",$exp);
                $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
                $publication['content'] = preg_replace("#/media/.+\.(jpe?g|gif|bmp|png)#i", "", $publication['content']);
                $urlbien = '/ensisocial/data'.$url1.$ext;
                echo '<p>'.$publication['content'].'</p>';
                echo '<div>';
                echo '<p><img src="'.$urlbien.'" class="img-responsive"></p>';
                echo "</div>";
            }
            if (preg_match("#/media/.+\.mp3#i",$publication['content'])) {
                $beginning = strpos($publication['content'], "/media/");
                $end = 39;
                $url1 = substr($publication['content'], $beginning, $end);
                $exp = substr($publication['content'], $beginning, $end+4);
                $expbien = preg_replace("# #","",$exp);
                $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
                $publication['content'] = preg_replace("#/media/.+\.mp3#i","",$publication['content']);
                $urlbien = '/ensisocial/data'.$url1.$ext;
                echo '<p>'.$publication['content'].'</p>';
                echo '<div>';
                echo '<p><audio src="'.$urlbien.'" controls></audio></p>';
                echo "</div>";
            }
            if (preg_match("#/media/.+\.(mp4|mped|wav)#i",$publication['content'])) {
                $beginning = strpos($publication['content'], "/media/");
                $end = 39;
                $url1 = substr($publication['content'], $beginning, $end);
                $exp = substr($publication['content'], $beginning, $end+4);
                $expbien = preg_replace("# #","",$exp);
                $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
                $publication['content'] = preg_replace("#/media/.+\.(mp4|mped|wav)#i", "", $publication['content']);
                $urlbien = '/ensisocial/data'.$url1.$ext;
                echo '<p>'.$publication['content'].'</p>';
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo '<p><video src='.$urlbien.' controls></video></p>';
                echo "</div>";
            }

				if($score >= 0){
					echo '<span class="score" style="color:#00DD00">'.$score.'</span>&nbsp;&nbsp;';
				} else {
					echo '<span class="score" style="color:#DD0000">'.$score.'</span>&nbsp;&nbsp;';
				}

				echo '<button  class="glyphicon glyphicon-thumbs-up btn btn-link thumb" onclick=clicup('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>&nbsp;&nbsp;';
				echo '<button  class="glyphicon glyphicon-thumbs-down btn btn-link thumb" onclick=clicdown('.$publication['newsfeedid'].','.$_SESSION['id'].') ></button>';
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
	</div> <!-- /.panel -->
	<?php
		} // /while
		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		echo '</div>'; /* /.newsfeed */
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>

