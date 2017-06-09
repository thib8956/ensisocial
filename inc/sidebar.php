<div class="col-sm-3 col-md-3"  role="complementary">
	<nav id="sidebar" class="sidebar affix hidden-print hidden-sm hidden-xs">
		<center>
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" class="img-circle img-responsive"></a>
			<h3>
				<?php
				if(!isset($user['name'])){
					echo $user['firstname'].' '.$user['lastname'];
				}else{
					echo $user['name'];
				}

				?>
			</h3>
			<p><a class="btn btn-default" href="/ensisocial/edit-profile.php">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Modifier mes informations
			</a></p>
		</center>

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
			<?php if(!isset($user["name"])){ ?>
				<center>
					<img class="img-circle" src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" border="0">
					<h3 class="media-heading"><?php echo $user['firstname'].' ';echo $user['lastname'].' ' ?><small><?php echo $user['town'] ?></small></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>Formation: </strong> <?php  echo $FORMATIONS[$user['formation']]; ?></p>
					<p class="text-left"><strong>Né le : </strong> <?php  echo date('d-m-Y', strtotime($user['birth'])); ?></p>
				</center>
			<?php }else{?>
				<center>
					<img class="img-circle" src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" border="0">
					<h3 class="media-heading"><?php echo $user['name']?></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>Description:</strong><br> <?php  echo $user['description']; ?></p>
				</center>
			<?php } ?>
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
