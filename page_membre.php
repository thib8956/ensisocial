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

<!-- Add a publication -->
<div class="row">
	<div class="col-sm-offset-3 col-md-6">
		<form action="publication.php" method="post" accept-charset="UTF-8">
			<?php
			$form = new Form($_POST, 'post');
			echo $form->inputfield('title', 'text', 'Titre de la publication');
			echo $form->inputtextarea('content', 'Contenu', 5, 16);
			echo $form->submit('Publier');
			echo '<input type="hidden" name="type" value="0" />
		</form>';
		?>
</div>
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
			$member=array();
			if($publication['type']==1){
				$right=$db->prepare('SELECT iduser FROM member WHERE idgroup=:id');
				$right->execute(array('id'=> intval($publication['place'])));
				while($testmember=$right->fetch()){
					array_push($member, $testmember['iduser']);
				}
			}


			if($publication['type']==0 or in_array($_SESSION['id'], $member)){
				$place = $db->query('SELECT * FROM users WHERE users.id='.$publication['place']);
				$user = $place->fetch();
				if($publication['type'] == 1){
					$group=$db->query('SELECT * FROM groupe WHERE groupe.id='.$publication['place']);
					$group=$group->fetch();
				}
				$commId += 1;
				$avatar = '/ensisocial/data/avatar/'.$publication['profile_pic'];

            if(!isset($_SESSION['commentUnfold'][$publication['newsfeedid']])) { //creation de la limite de commentaire
            	$_SESSION['commentUnfold'][$publication['newsfeedid']]=5;
            }
            ?>

            <div class="panel panel-default">
            	<div class="panel-heading" >
            		<a class="pull-left" href=<?php echo '"/ensisocial/recherche/searchProfil.php?id='.$publication['authorid'].'"'; ?>>
            			<img class="img-thumbnail" src=<?php echo '"'.$avatar.'"'; ?> alt="avatar" style="max-height: 100px;">
            		</a>
            		<?php if ($_SESSION['id'] == $publication['authorid']): ?>
            			<a class="btn btn-default pull-right supprNews" href=<?php echo '"delete.php?id='.$publication['newsfeedid'].'"'; ?>>
            				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            				Supprimer
            			</a>
            		<?php endif;

            		$score = $publication['score'];
            		if($publication['place']==0 ){
            			echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'</h2>';
            		} elseif($publication['place']!=0 && $publication['type']==0){
            			echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
            			<small>
            				<span class="glyphicon glyphicon-chevron-right">
            				</span>
            				<a href="/ensisocial/recherche/searchProfil.php?id='.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].'
            				</a>
            			</small>
            		</h2>';
            		} else {
		            	if(array_key_exists($group['name'], $FORMATIONS)){
		            		echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
		            		<small>
		            			<span class="glyphicon glyphicon-chevron-right">
		            			</span>
		            			<a href="/ensisocial/recherche/searchProfil.php?id='.$user['id'].'">'.$FORMATIONS[$group['name']].'
		            			</a>
		            		</small>
		            	</h2>';
		            	} else {
		            		echo '<h2>'.$publication['firstname'].' '.$publication['lastname'].'
		            		<small>
		            			<span class="glyphicon glyphicon-chevron-right">
		            			</span>
		            			<a href="/ensisocial/recherche/searchProfil.php?id='.$user['id'].'">'.$group['name'].'
		            			</a>
		            		</small>
		            	</h2>';
		         		}
            }
            echo '<h3>'.$publication['title'].'</h3>';

            ?>
        </div> <!-- .panel-heading -->
        <div class="panel-body" id=<?php echo 'post'.$publication['newsfeedid']?>>
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
					include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/comment/comment.php'); // include à répétition donc ne pas mettre include_once
					echo '</ul>';
					?>
					<!-- Add a comment -->
					<div class="input-group">
						<?php echo '<form id="comm'.$commId.'" class="submitAjax" action="/ensisocial/comment/comment_submit.php" method="post" accept-charset="utf-8">' ?>
							<input class="form-control" placeholder="Ajouter votre commentaire" type="text" name="add" autocomplete="off">
							<?php echo '<input type="hidden" name="back" value='.$_SERVER['REQUEST_URI'].'>' ?>
							<?php echo '<input name="post_id" type="hidden" value='.$publication['newsfeedid'].'>' ?>
						</form>

                        <?php echo '<form class="submitAjax formulaire" action="/ensisocial/comment/commentUnfold.php?id='.$publication['newsfeedid'].'" method="post" accept-charset="utf-8">'; ?>
                            <input type="submit" value=<?php
                            	echo '"Voir plus de commentaires ('.$nbrDisplayComment.'/'.$nbrTotalComment.')"';
                             ?>
							class=<?php echo '"btn btn-default inputButton ';
								if($nbrDisplayComment == $nbrTotalComment) echo 'disabled ';
								echo '"';
							?>>
                        </form>

                        <?php echo '<form class="submitAjax formulaire" action="/ensisocial/comment/commentfold.php?id='.$publication['newsfeedid'].'" method="post" accept-charset="utf-8">'; ?>
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
	}
		} // /while
		echo '</div>'; /* /.col-sm-offset-2 .col-md-9 */
		echo '</div>'; /* /.newsfeed */
        include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/messagerie/chatBox.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
		?>
