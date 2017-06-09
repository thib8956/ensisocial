<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
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
				<img class="hidden-xs" src="/ensisocial/img/ensisocial.png" alt="logo" height="50px">
				<img class="visible-xs" src="/ensisocial/img/ensisocial.png" alt="logo" height="70px">
			</a>
		</div> <!-- .navbar-header -->

		<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
			<ul class="nav navbar-nav">
				<?php if (!isset($_SESSION['id'])): ?>
					<li><a href="inscription.php" title="inscription"><span class="glyphicon glyphicon-user"></span>&nbsp;Inscription</a></li>
				<?php else: ?>
					<!-- Page de profil personelle -->
					<li><a href="/ensisocial/recherche/searchProfil.php?id=<?php echo $_SESSION['id']; ?>">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profil
					</a></li>
					<li><a href="/ensisocial/group/group.php">
						<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Groupe
					</a></li>
					<li><a href="/ensisocial/messagerie/chatPage.php">
						<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;Messagerie
					</a></li>
					<li><a href="/ensisocial/disconnection.php">
						<span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Déconnexion
					</a></li>
				<?php endif ?>
			</ul>

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
		</div><!--/.nav-collapse -->
	</div> <!-- /.container -->
</nav>
