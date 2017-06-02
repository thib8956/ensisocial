<?php
session_start();
$title=$_SESSION['firstname'];
include('inc/header.php');

$stmt = $db->query('SELECT newsfeed.id,firstname,lastname,content,title,`date`
	FROM newsfeed
	JOIN authornews ON newsfeed.id = authornews.newsfeedid
	JOIN users ON users.id = authornews.authorid
	ORDER BY date DESC'
	);
$score = 42;


?>

<div class="container col-sm-2 affix">
	<div class="span3 well">
		<center>
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" class="img-circle"></a>
			<h3><?php echo $_SESSION['firstname'].' ';echo$_SESSION['lastname'];?></h3>
		</center>
	</div>

	<script>
		javascript:member();
	</script>
	<!-- ce div n'est pas vraiment vide il affiche la liste des membres connecté celui qui le supprime je le biffle signé: le respo web-->
	<div id="memberconnected" ></div>
</div>

<!-- Pop up lorsque l'on clique sur l'image-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="profil" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">times</button>
			</div>
			<div class="modal-body">
				<center>
					<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
					<h3 class="media-heading"><?php echo $_SESSION['firstname'].' ';echo$_SESSION['lastname'].' ' ?><small><?php echo $_SESSION['town'] ?></small></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>formation: </strong> <?php  echo $_SESSION['formation'] ?></p>
					<p class="text-left"><strong>né le : </strong> <?php  echo date('d-m-Y', strtotime($_SESSION['birth'])); ?></p>
				</center>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about Joe</button>
				</center>
			</div>
		</div>
	</div>
</div>

<!-- Add a publication -->
<div class="col-sm-offset-2 col-md-10">
	<div class="row">
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
<div class="col-sm-offset-2 col-md-10">
	<?php
	echo '<div class="panel panel-white post panel-shadow">
	<div class="post-heading">';
		while ($res=$stmt->fetch()){
			?>
			<div class="row well">
				<?php

				echo '<h2>'.$res['firstname'].' '.$res['lastname'].'</h2>';
				echo '<h3>'.$res['title'].'</h3>';
				echo '<p>'.$res['content'].'</p>';
				echo '<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;'.$score.'&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-down"></span>';
				echo '<p class="text-right small">'.$res['date'].'</p>';
				include('comment.php'); // include à répétition donc ne pas mettre include_once
				?>

			</div>

			<?php
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
		include('inc/footer.php');
		?>

