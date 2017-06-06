<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title="Profil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>

<section id="profil"> // un beau contour pour le tout avec un fond spécial
    <div class="divprofil"><p>Image de profil <a>Modifier</a></p></div> //divprofil pour souligner
    <div class="divprofil"><p>Mot de passe <a>Modifier</a></p></div>
    <div class="divprofil"><p>Nom</p></div>
    <div class="divprofil"><p>Prénom</p></div>
    <div class="divprofil"><p>Filière</p></div>
    <div class="divprofil"><p>Mail</p></div>
    <div class="divprofil"><p>Date de naissance</p></div>
    <div class="divprofil"><p>Adresse <a>Modifier</a></p></div>
    <div class="divprofil"><p>Code postal <a>Modifier</a></p></div>
    <div class="divprofil"><p>Ville <a>Modifier</a></p></div>
    <div class="divprofil"><p>Image de profil <a>Modifier</a></p></div>
</section>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>