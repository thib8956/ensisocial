<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="sidebar-toggle btn navbar-left" data-toggle="collapse" data-target="#sidebar" onclick="toggleSidebar()">
				<span class="sr-only">Toggle sidebar</span>
				<span class="glyphicon glyphicon-menu-down"></span>
			</button>

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<?php
			if(isset($_SESSION['id'])) {
				echo '<a class="navbar-left" href="/ensisocial/page_membre.php">';
			}
			else {
				echo '<a class="navbar-left" href="/ensisocial/index.php">';
			}
			?>
			<img src="/ensisocial/img/ensisocial.png" alt="logo" height="50">
		</a>
		</div> <!-- .navbar-header -->

		<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px">
			<ul class="nav navbar-nav">
				<?php if (!isset($_SESSION['id'])): ?>
					<li><a href="inscription.php" title="inscription"><span class="glyphicon glyphicon-user"></span>&nbsp;Inscription</a></li>
				<?php else: ?>
					<!-- Page de profil personelle -->
					<li><a href="/ensisocial/recherche/searchProfil.php?id=<?php echo $_SESSION['id']; ?>">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profil
					</a></li>
					<li><a href="/ensisocial/upload_form.php">
						<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Uploads
					</a></li>
					<li><a href="/ensisocial/messagerie/chatPage.php">
						<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;Messagerie
					</a></li>
					<li><a href="/ensisocial/disconnection.php">
						<span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Déconnexion
					</a></li>
				<?php endif ?>

				<?php if (isset($_SESSION['id'])): ?>
					<!-- Searchbar -->
					<form class="nav navbar-form navbar-right" method="post" action="/ensisocial/recherche/searchPage.php" role="search">
						<div class="input-group add-on">
							<input type="text" id="searchBar" class="form-control" name="searchBar" placeholder="Rechercher">
							<div class="input-group-btn">
								<button type="submit" id="search" class="btn btn-primary" name="search">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				<?php endif ?>
			</ul>
		</div><!--/.nav-collapse -->
	</div> <!-- /.container -->
</nav>
