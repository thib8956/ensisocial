<?php
$title="Error 403";
include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-2">
				<h2>Accès interdit <small style="color:red;">Erreur 403</small></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-2">
				<p>L'accès à la page demandé n'est pas autorisé !</p>
				 <a href="/ensisocial/index.php" class="btn btn-danger btn-large"><i class="glyphicon glyphicon-home"></i>&nbsp;Revenir à l'accueil</a>
		</div>
	</div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
