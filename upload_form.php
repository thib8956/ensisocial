<?php
$title="Accueil";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
?>
<form method="post" enctype="multipart/form-data" action="upload.php">
    <p>
        <input type="file" name="fichier">
        <input type="submit" name="upload" value="Uploader">
    </p>
</form>
<p>Taille maximum par fichier autorisée par le serveur = <?php echo ini_get('upload_max_filesize').'o'?></p>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>