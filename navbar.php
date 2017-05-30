<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<?php if (!isset($_SESSION['username'])){
			echo '<li><a href="inscription.php" title="inscription">Inscription</a></li>';
			echo '<li><a href="connection.php" title="connexion">Connexion</a></li>';
		} else {
			echo '<li><a href="">Profil</a></li>';
			?>
			<form class="navbar-form navbar-left" method="post" action="userSearch.php">
				<div class="form-group">
					<input type="text" class="form-control" name="searchBar" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default" name="search">Submit</button>
			</form>
			<?php
			echo '<li><a href="disconnection.php">Déconnexion</a></li>';
		}
		?>
	</ul>
</nav>