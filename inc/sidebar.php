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
			<p><a class="btn btn-default" href="/ensisocial/edit-profile.php">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Modifier mes informations
			</a></p>
		</center>
		<!-- List of connected members. -->
		<p>Autres membres : </p>
		<div id="memberconnected">Membres</div>
	</div>
</div>

<!-- Pop up when clicking picture -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="profil" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn btn-danger btn-lg" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
			<div class="modal-body">
				<center>
					<img class="img-circle" src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" border="0">
					<h3 class="media-heading"><?php echo $_SESSION['firstname'].' ';echo $_SESSION['lastname'].' ' ?><small><?php echo $_SESSION['town'] ?></small></h3>
				</center>
				<hr>
				<center>
					<p class="text-left"><strong>Formation: </strong> <?php  echo $FORMATIONS[$_SESSION['formation']]; ?></p>
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
