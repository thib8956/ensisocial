<?php
session_start();

$title=$_SESSION['username'];
include("header.php");
?>

<form method="post" action="userSearch.php">
    <p>
        <label for "rechercheBar"> Recherche : </label>
        <input type="text" name="searchBar" placeholder="recherche..." />
    </p>
    <p>
        <input type="submit" value="Rechercher" name="search" />
    </p>
</form>

<?php
echo '<p>Bonjour, '.$_SESSION['username'].'</p>';

echo '<a href="disconnection.php">Déconnexion</a>';
?>

<div>
    <p><img id="profilepic" href="photoprofil.jpg"/></p>
</div>
<div id="newsstream">
    <p>Insérez ici messages variés</p>
</div>