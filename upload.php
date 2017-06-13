<?php
session_start();
if (!isset($_SESSION['id'])){
    header('Location: /ensisocial/index.php');
}
$title="Uploads";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
//$user = $_SESSION; // pour la sidebar
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
<?php
if( isset($_POST['upload']) ) // si formulaire soumis
{
    $tmp_file = $_FILES['fichier']['tmp_name'];
    $fname = md5(uniqid(rand(), true));
    $ext = '.'.substr(strrchr($_FILES['fichier']['name'], '.'), 1);
    $content_dir = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/media/'.$fname.$ext; // dossier où sera déplacé le fichier


    if( !is_uploaded_file($tmp_file) )
    {
        exit("Le fichier est introuvable");
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['fichier']['type'];
    if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')
      && !strstr($type_file, 'mp4') && !strstr($type_file, 'mpeg') && !strstr($type_file, 'wav') && !strstr($type_file, 'pdf'))
    {
        exit("Le fichier n'est pas dans un format pris en charge");
    }

    // on copie le fichier dans le dossier de destination
    $name_file = $_FILES['fichier']['name'];
    $ret = move_uploaded_file($tmp_file, $content_dir);
    if ($ret == false)
    {
        //print_errors($ret);
        echo("Voici votre lien : ");
        echo("/media/".$fname.$ext);
        //exit("Impossible de copier le fichier dans $content_dir");
    }
    else {
        //print_errors($ret);
        echo "Le fichier a bien été uploadé <br>";
        echo("Voici votre lien : ");
        echo("/media/".$fname.$ext);
    }
}?>
</div>
<?php
function print_errors($retcode){
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );
    if ($retcode > 0){
        echo '<div class="alert alert-danger">';
        echo $phpFileUploadErrors[$retcode];
        echo '</div>';
    }
}

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
