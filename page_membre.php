<?php
session_start();

$title=$_SESSION['firstname'];
include('inc/header.php');

$stmt = $db->query('SELECT * from newsfeed join authornews on newsfeed.id=authornews.newsfeedid join users on users.id=authornews.authorid ORDER BY date DESC');
$score = 42;
$profil=$db->query('SELECT * from users WHERE id='.$_SESSION['id']);

?>


<div class="col-sm-2 affix">
	<div class="span3 well">
		<center>
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" class="img-circle"></a>
			<h3><?php echo $_SESSION['firstname'].' ';echo$_SESSION['lastname'];?></h3>
		</center>
	</div>
	<!-- Modal -->
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
						<p class="text-left"><strong>né le : </strong> <?php  date('d-m-Y', strtotime($_POST['birth'])) ?></p>
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
	<script>
		javascript:ajax();
	</script>
	<!-- <button onclick='javascript:ajax()'>Afficher</button> -->
	<div id="ta_div" ></div>

</div>

<div class="col-sm-offset-2 col-md-10 ">
	<?php
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
			?>
		</div>

	<?php
}
echo '</div>';
include('footer.php');
?>

