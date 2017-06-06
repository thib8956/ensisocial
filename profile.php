<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title="Profil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>

<div class="container"> <!-- faudrait un beau contour pour le tout avec un fond spécial -->
    <div class="info">
    <div class="row"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
        <div class="col-md-2">Image de profil</div>
        <div class="col-md-2"><a>Modifier</a></div>
    </div>
    </div><div class="info"> <!-- regroupe 1 type d'info dans un bloc, à arranger dans le css -->
    <div class="row">
        <div class="col-md-2">Mot de passe</div>
        <div class="col-md-2"><a>Modifier</a></div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Nom</div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Prénom</div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Filière</div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Mail</div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Adresse</div>
        <div class="col-md-2"><a>Modifier</a></div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Code postal</div>
        <div class="col-md-2"><a>Modifier</a></div>
    </div>
    </div><div class="info">
    <div class="row">
        <div class="col-md-2">Ville</div>
        <div class="col-md-2"><a>Modifier</a></div>
    </div>
    </div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>