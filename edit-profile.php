<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
}
$title="Profil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
$req = $db->prepare('SELECT * FROM users WHERE email = :email');
$req->execute(array('email'=> $_SESSION["email"]));
$profile = $req->fetch();
$form = new Form($_POST,"profile_page");

?>

<div class="container panel-group" id="accordion">

    <!-- Edit profile picture -->
    <div class="panel">
        <div class="row panel-heading"> <!-- panel-heading pour souligner, row pour la hauteur-->
            <div class="col-md-2">Image de profil</div>
            <div class="col-md-4 text-center">
                <?php
                    echo "<img class='img-circle' alt='profile_pic' src='data/avatar/".$profile["profile_pic"]."' style='height:50px;width:50px;' />";
                ?>
            </div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#profilepic">Modifier</a></div> <!-- href correspond à ce que ça collapse quand on appuie -->
        </div>
        <div id="profilepic" class="panel-collapse collapse">
            <form action="edit-profile/update-profile.php" method="post"  accept-charset="utf-8" enctype="multipart/form-data">
            <?php
                echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />';
                echo $form->inputfile('picture', 'Choisissez une image de profil');
                echo $form->submit("Valider");
            ?>
            </form>
        </div>
    </div>

    <!-- Edit password -->
    <div class="panel">
        <?php
        if (isset($_GET['pwd'])){
            if ($_GET['pwd']==0){
+                echo "<div class='row alert alert-danger'><div class='col-md-8 text-center'>Il faut remplir les champs</div></div>"; 
             } elseif ($_GET['pwd']==1){
-                echo "<div class='alert alert-success row'><div class='row'><div class='col-md-8 text-center'>Votre mdp a bien été changé !</div></div>"; 
+                echo "<div class='row alert alert-danger'>
+                        <div class='col-md-8 text-center'>Mot de passe trop court</div>
+                      </div>"; 
+            } elseif ($_GET['pwd']==2){
+                echo "<div class='alert alert-success row'>
+                            <div class='col-md-8 text-center'>Votre mdp a bien été changé !</div>
+                      </div>";
            }
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Mot de passe</div>
            <div class="col-md-4 text-center">***************</div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#password">Modifier</a></div>
        </div>
        <div id="password" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'oldpassword',
                    'password',
                    'Ancien mot de passe'
                );
                echo $form->inputfield(
                    'newpassword',
                    'password',
                    'Nouveau mot de passe'
                );
                echo $form->inputfield(
                    'repassword',
                    'password',
                    'Retapez votre mot de passe'
                );
                echo $form->submit("Valider");
            ?>
            </form>
        </div>
    </div>

    <!-- Edit firstname -->
    <div class="panel">
        <?php
        if (isset($_GET['fn']) && $_GET['fn']==1){
                echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre prénom a bien été changé</div></div>";
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Prénom</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["firstname"];
                ?>
            </div>
            <div class="col-md-2">
                <a data-toggle="collapse" data-parent="#accordion" href="#firstname">Modifier</a>
            </div>
        </div>
        <div id="firstname" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'firstname',
                    'string',
                    'Prénom'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit lastname -->
    <div class="panel">
        <?php
        if (isset($_GET['ln'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre nom a bien été changé</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Nom</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["lastname"];
                ?>
            </div>
            <div class="col-md-2">
                <a data-toggle="collapse" data-parent="#accordion" href="#lastname">Modifier</a>
            </div>
        </div>
        <div id="lastname" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'lastname',
                    'string',
                    'Nom'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit formations -->
    <div class="panel">
        <?php
        if (isset($_GET['fm'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre formation a bien été changée</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Filière</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $FORMATIONS[$profile['formation']];
                ?>
            </div>
            <div class="col-md-2">
                <a data-toggle="collapse" data-parent="#accordion" href="#formation">Modifier</a>
            </div>
        </div>
        <div id="formation" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputsection('formation','string','formation',
                    $FORMATIONS);
                echo $form->submit("Valider");
                ?>
                <input type="hidden" name="oldformation" class="btn btn-primary-outline" value=<?php echo $profile['formation']?> />
            </form>
        </div>
    </div>

    <!-- Display email -->
    <div class="panel">
        <div class="row panel-heading">
            <div class="col-md-2">Mail</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["email"];
                ?>
            </div>
        </div>
    </div>

    <!-- Edit address -->
    <div class="panel">
        <?php
        if (isset($_GET['ad'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre adresse a bien été changée</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Adresse</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["addresse"];
                ?></div>
            <div class="col-md-2">
                <a data-toggle="collapse" data-parent="#accordion" href="#address">Modifier</a>
            </div>
        </div>
        <div id="address" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'address',
                    'string',
                    'Adresse'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit zipcode -->
    <div class="panel">
        <?php
        if (isset($_GET['zip'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre code postal a bien été changé</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Code postal</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["zipcode"];
                ?>
            </div>
            <div class="col-md-2">
                <a data-toggle="collapse" data-parent="#accordion" href="#zipcode">Modifier</a>
            </div>
        </div>
        <div id="zipcode" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'zipcode',
                    'int',
                    'Code postal'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit town -->
    <div class="panel">
        <?php
        if (isset($_GET['tn'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre ville a bien été changée</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Ville</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["town"];
                ?>
            </div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#town">Modifier</a></div>
        </div>
        <div id="town" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'town',
                    'string',
                    'Ville'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit phone number -->
    <div class="panel">
        <?php
        if (isset($_GET['tel'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre numéro de téléphone a bien été changé</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Téléphone</div>
            <div class="col-md-4 text-center">
                <?php
                    $length=strlen($profile["phone"]);
                    $phone="";
                    for ($i=0;$i<$length;$i++){
                        if ($i!=0 && $i%2==0){
                            $phone.=" ";
                        }
                        $phone.=$profile["phone"][$i];
                    } //Pour l'affichage du tel
                    echo $phone;
                ?>
            </div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#phone">Modifier</a></div>
        </div>
        <div id="phone" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4">
                <?php
                echo $form->inputfield(
                    'phone',
                    'string',
                    'Numéro de téléphone'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>

    <!-- Edit birth date -->
    <div class="panel">
        <?php
        if (isset($_GET['birth'])){
            echo "<div class='alert alert-success row'><div class='col-md-8 text-center'>Votre date de naissance a bien été changée</div></div>"; //vert
        }
        ?>
        <div class="row panel-heading">
            <div class="col-md-2">Date de naissance</div>
            <div class="col-md-4 text-center">
                <?php
                    echo $profile["birth"];
                ?>
            </div>
            <div class="col-md-2"><a data-toggle="collapse" data-parent="#accordion" href="#birth">Modifier</a></div>
        </div>
        <div id="birth" class="panel-collapse collapse row">
            <form action="edit-profile/update-profile.php" method="post" accept-charset="utf-8" class="col-md-4 d-inline">
                <?php
                echo $form->inputfield(
                    'birth',
                    'date',
                    'Date de naissance'
                );
                echo $form->submit("Valider");
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
