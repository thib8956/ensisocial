<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<?php if (!isset($_SESSION['email'])){
			echo '<li><a href="inscription.php" title="inscription">Inscription</a></li>';
			// echo '<li><a href="connection.php" title="connexion">Connexion</a></li>';
		} else {
			echo '<li><a href="">Profil</a></li>';
            echo '<li><a href="">Actualités</a></li>';
            echo '<li><a href="">Groupes</a></li>';
            echo '<li><a href="">Contacts récents</a></li>';
            echo '<li><a href="disconnection.php">Déconnexion</a></li>';
			?>
			<form class="navbar-form navbar-left" method="post" action="searchPage.php">
				<div class="input-group add-on">
					<input type="text" id="searchBar" class="form-control" name="searchBar" placeholder="Rechercher" autocomplete="off">
					<div class="input-group-btn">
						<button type="submit" id="search" class="btn btn-primary" name="search"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			<?php
		}
		?>
	</ul>
</nav>
