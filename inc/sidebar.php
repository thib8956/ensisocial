<div class="col-sm-3 col-md-3"  role="complementary">
	<nav id="sidebar" class="sidebar affix hidden-print hidden-sm hidden-xs">
		<div class="text-center">
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal">
				<img src=<?php echo $pic_path ?> id="aboutme" width="140" height="140" alt="avatar" class="img-circle img-responsive center-block">
			</a>
			<h3>
				<?php
				echo $user['firstname'].' '.$user['lastname'];
				?>
			</h3>
			<p><a class="btn btn-default" href="/ensisocial/edit-profile.php">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Modifier mes informations
			</a></p>
		</div>

		<!-- List of connected members. -->
		<p>Autres membres : </p>
		<div id="memberconnected">Membres</div>
		<a href="#top" class="back-to-top">Revenir en haut</a>
	</nav>
</div>

<!-- Pop up when clicking picture -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="profil" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn btn-danger btn-lg" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<img class="img-circle img-responsive center-block" src=<?php echo $pic_path ?> alt="avatar" id="aboutme" width="140" height="140">
					<h3 class="media-heading"><?php echo $user['firstname'].' ';echo $user['lastname'].' ' ?><small><?php echo $user['town'] ?></small></h3>
					<p class="text-left">
						<strong>Formation: </strong> <?php  echo $FORMATIONS[$user['formation']]; ?>
					</p>
					<p class="text-left">
						<strong>Né le : </strong> <?php  echo date('d-m-Y', strtotime($user['birth'])); ?>
					</p>
				</div>
				<hr>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</center>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.sidebar {
		z-index: 1;
		background: white;
		left: 0;
		padding: 10px;
	}
</style>

<script type="text/javascript">
function toggleSidebar(){
	$('#sidebar').toggleClass('hidden-xs');
	$('#sidebar').toggleClass('hidden-sm');
}

</script>
