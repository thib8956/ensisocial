<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-left" href="index.php">
				<img class="hidden-xs" src="img/ensisocial.jpg" alt="logo" height="50px">
				<img class="visible-xs" src="img/ensisocial.jpg" alt="logo" height="70px">
			</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
			<ul class="nav navbar-nav">

				<?php if (!isset($_SESSION['id'])){
					echo '<li><a href="inscription.php" title="inscription"><span class="glyphicon glyphicon-user"></span>Inscription</a></li>';
				} else {
					echo '<li><a href="">Profil</a></li>';
					/*echo '<li><a href="">Actualités</a></li>';
					echo '<li><a href="">Groupes</a></li>';*/
					echo '<li><a href="">Contacts récents</a></li>';
                    echo '<li><a href="chatPage.php">Messagerie</a></li>';
					echo '<li><a href="disconnection.php">Déconnexion</a></li>';
				}
				?>

			</ul>
			<!-- Searchbar -->
			<form class="nav navbar-form navbar-right" method="post" action="searchPage.php" role="search">
				<div class="input-group add-on">
					<input type="text" id="searchBar" class="form-control" name="searchBar" placeholder="Rechercher">
					<div class="input-group-btn">
						<button type="submit" id="search" class="btn btn-primary" name="search">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</div>
				</div>
			</form>
		</div><!--/.nav-collapse -->
	</div>
</nav>

<?php include_once('footer.php'); ?>
