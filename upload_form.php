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

<!-- <div id = "message_tele"><?php if (isset($_SESSION['resultat_telecharg'])) {echo  htmlspecialchars($_SESSION['resultat_telecharg']); unset($_SESSION['resultat_telecharg']);}?> -->
    <!--    </div>
               
        <form enctype = "multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?form_file=1'?>" method = "post" onsubmit = "Verif_attente('userfile','message_tele')">
        <p>
        <input type = "hidden" name = "chargement" value = "1" />

        <input type = "hidden" name = "MAX_FILE_SIZE"  value = "<?php echo Return_Octets(ini_get('upload_max_filesize'))?>" />
        
        <input id = "userfile" name = "userfile" type = "file" size = "70" />
        <input type = "submit" value = "Envoyez"  style = "margin-left:5px" />
        </p>
        </form> -->
