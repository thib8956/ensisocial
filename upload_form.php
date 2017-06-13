<?php
session_start();
$title="Uploads";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
//$user = $data; // Pour la sidebar
//include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');
try{
	$user = $_SESSION;
	$profile  = $db->query('SELECT profile_pic from users WHERE id='.$_SESSION['id']);
	$data = $profile->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = '/ensisocial/data/avatar/default-group.png';
	}
}catch(PDOException $e){
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/sidebar.php');

?>
<div class="col-sm-offset-3 col-md-8">
<form method="post" enctype="multipart/form-data" action="upload.php">
    <p>
        <input type="file" name="fichier">
        <input type="submit" name="upload" value="Uploader">
    </p>
</form>
<p>Taille maximum par fichier autorisée par le serveur = <?php echo ini_get('upload_max_filesize').'o'?>
<br> Pour pouvoir utiliser votre image marquez le chemin qui vous sera écrit dans la zone de texte de votre publication =D</p>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/messagerie/chatBox.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
