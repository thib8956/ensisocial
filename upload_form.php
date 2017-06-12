<?php
session_start();
$title="Uploads";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
//$user = $data; // Pour la sidebar
//include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');
?>
<form method="post" enctype="multipart/form-data" action="upload.php">
    <p>
        <input type="file" name="fichier">
        <input type="submit" name="upload" value="Uploader">
    </p>
</form>
<p>Taille maximum par fichier autorisée par le serveur = <?php echo ini_get('upload_max_filesize').'o'?>
<br> Pour pouvoir utiliser votre image marquez le chemin qui vous sera écrit dans la zone de texte de votre publication =D</p>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>