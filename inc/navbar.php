<nav class="navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">
				<img alt="logo" src="img/ensisocial.jpg" height="100%">
			</a>
		</div>
		<!-- Searchbar -->
		<form class="navbar-form navbar-right" method="post" action="searchPage.php">
			<div class="input-group add-on">
				<input type="text" id="searchBar" class="form-control" name="searchBar" placeholder="Rechercher" autocomplete="off">
				<div class="input-group-btn">
					<button type="submit" id="search" class="btn btn-primary" name="search"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>

		<ul class="nav navbar-nav">
			<?php if (!isset($_SESSION['email'])){
				echo '<li><a href="inscription.php" title="inscription"><span class="glyphicon glyphicon-user"></span>Inscription</a></li>';
			// echo '<li><a href="connection.php" title="connexion">Connexion</a></li>';
			} else {
				echo '<li><a href="">Profil</a></li>';
				echo '<li><a href="">Actualités</a></li>';
				echo '<li><a href="">Groupes</a></li>';
				echo '<li><a href="">Contacts récents</a></li>';
				echo '<li><a href="disconnection.php">Déconnexion</a></li>';
			}
			?>
		</ul>
	</div>
</nav>
