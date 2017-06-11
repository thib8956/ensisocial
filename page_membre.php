<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
session_start();
}
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title = $_SESSION['firstname'];
$user = $_SESSION;
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

try {
	$stmt = $db->query('SELECT *
		FROM newsfeed
		JOIN authornews ON newsfeed.id = authornews.newsfeedid
		JOIN users ON users.id = authornews.authorid
		ORDER BY date DESC'
		);


	/* Fetch profile picture */
	$profile  = $db->query('SELECT profile_pic from users WHERE id='.$_SESSION['id']);
	$data = $profile->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = '/ensisocial/data/avatar/default-profile.png';
	}
} catch (PDOException $e) {
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}

// Sidebar
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');
?>

<!-- Style des boutton afficher/reduire les commentaires-->
<style type="text/css">
    .formulaire {
        display: inline-flex;
        margin-top: 3px;
    }
    .inputButton:hover {
        cursor: pointer;
    }
</style>

<!-- Add a publication -->
<div class="row">
	<div class="col-sm-offset-3 col-md-8">
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
<div class="newsfeedwrap">
	<div class="col-sm-offset-3 col-md-8 newsfeed">
		<?php
		$commId=0;
		while ($publication=$stmt->fetch()) {
			$place= $db->query('SELECT * FROM users WHERE users.id='.$publication['place']);
			$user=$place->fetch();
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
						<a class="btn btn-default pull-right supprNews" href="<?php echo 'delete.php?id='.$publication['newsfeedid']; ?>">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							Supprimer
						</a>
					<?php endif?>
					<?php
					$score = $publication['score'];
					if($publication['place']==0){
						echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'</h2>';
					} else {
						echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
						<small>
							<span class="glyphicon glyphicon-chevron-right">
							</span>
							<a href="/ensisocial/recherche/searchProfil.php?id='.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].'
							</a>
						</small>
					</h2>';
				}
				echo '<h3>'.$publication['title'].'</h3>'; //#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))#
				?>
			</div> <!-- .panel-heading -->
			<div class="panel-body">
				<?php
				echo '<p>'.$publication['content'].'</p>';
                if (preg_match("#https?://www\.youtube\.com/watch\?v=#",$publication['content'])) {
                    echo '<div class="embed-responsive embed-responsive-16by9">';
                    $beginning = strpos($publication['content'], "https://www.youtube.com/watch?v=");
                    $end = $beginning+43;
                    $url1 = substr($publication['content'], $beginning, $end);
                    $urlbien = substr_replace($url1,"embed/",24,8);
                    echo '<p><iframe src='.$urlbien.'></iframe></p>';
                    echo "</div>";
                }
                if (preg_match("#/media/.+\.(jpe?g|gif|bmp|png)#",$publication['content'])) {
                    echo '<div>';
                    // Get file extension
					$ext = '.'.substr(strrchr($publication['content'], '.'), 1);
                    $beginning = strpos($publication['content'], "/media/");
                    $end = $beginning+39;
                    $url1 = substr($publication['content'], $beginning, $end);
                    $urlbien = '/ensisocial/data'.$url1.$ext;
                    echo '<p><img src="'.$urlbien.'" class="img-responsive"></p>';
                    echo "</div>";
                }
                if (preg_match("#/media/.+\.mp3#",$publication['content'])) {
                    echo '<div>';
                    // Get file extension
					$ext = '.'.substr(strrchr($publication['content'], '.'), 1);
                    $beginning = strpos($publication['content'], "/media/");
                    $end = $beginning+39;
                    $url1 = substr($publication['content'], $beginning, $end);
                    $urlbien = '/ensisocial/data'.$url1.$ext;
                    echo '<p><audio src="'.$urlbien.'" controls></audio></p>';
                    echo "</div>";
                }
                if (preg_match("#/media/.+\.(mp4|mped|wav)#",$publication['content'])) {
                    echo '<div>';
                    $beginning = strpos($publication['content'], "/media/");
                    $end = $beginning+36;
                    $url1 = substr($publication['content'], $beginning, $end);
                    $urlbien = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data'.$url1;
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

                        <?php echo '<form class="submitAjax formulaire" action="/ensisocial/php/commentUnfold.php?id='.$publication['newsfeedid'].'" method="post" accept-charset="utf-8">'; ?>
                            <input type="submit" value=<?php
                            	echo '"Voir plus de commentaires ('.$nbrDisplayComment.'/'.$nbrTotalComment.')"';
                             ?>
							class=<?php echo '"btn btn-default inputButton ';
								if($nbrDisplayComment == $nbrTotalComment) echo 'disabled ';
								echo '"';
							?>>
                        </form>

                        <?php echo '<form class="submitAjax formulaire" action="/ensisocial/php/commentfold.php?id='.$publication['newsfeedid'].'" method="post" accept-charset="utf-8">'; ?>
                        	<input type="submit" value="Réduire les commentaires" class=<?php
	                        	echo '"btn btn-default inputButton ';
	                        	if ($_SESSION['commentUnfold'][$publication['newsfeedid']]==5) echo 'disabled';
	                        	echo '"';
                        	?>>
                        </form>
                    </div>
				</div> <!-- /.panel-body -->
			</div> <!-- /.panel -->
		<?php
		} // /while
		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		echo '</div>'; /* /.newsfeed */
        include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/messagerie/chatBox.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>
