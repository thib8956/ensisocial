<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title="Profil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>

<div class="container panel-group" id="accordion"> <!-- faudrait un beau contour pour le tout avec un fond spécial -->
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Image de profil</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#profilepic">Modifier</a></div>
        </div>
        <div id="profilepic" class="panel-collapse collapse">Insérer ici le truc pour changer d'image</div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Mot de passe</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#password">Modifier</a></div>
        </div>
        <div id="password" class="panel-collapse collapse">
                Insérer ici le truc pour changer de mdp
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Nom</div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Prénom</div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Filière</div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Mail</div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Adresse</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#address">Modifier</a></div>
        </div>
        <div id="address" class="panel-collapse collapse">
                Insérer ici le truc pour changer d'adresse
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Code postal</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#postalcode">Modifier</a></div>
        </div>
        <div id="postalcode" class="panel-collapse collapse">
                Insérer ici le truc pour changer de code postal
        </div>
    </div>
    <div class="panel panel-default">
        <div class="row panel-heading"> <!-- rajouter une classe pour une border-bottom si possible jpense ça ferait beau-->
            <div class="col-md-2">Ville</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#town">Modifier</a></div>
        </div>
        <div id="town" class="panel-collapse collapse">
                Insérer ici le truc pour changer de ville
        </div>
    </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>