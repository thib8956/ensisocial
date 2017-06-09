<?php

if( isset($_POST['upload']) ) // si formulaire soumis
{
    $content_dir = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/uploads/'; // dossier où sera déplacé le fichier

    $tmp_file = $_FILES['fichier']['tmp_name'];

    if( !is_uploaded_file($tmp_file) )
    {
        exit("Le fichier est introuvable");
    } 

    // on vérifie maintenant l'extension
    $type_file = $_FILES['fichier']['type'];
    echo $type_file;
    if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')
      && !strstr($type_file, 'mp4') && !strstr($type_file, 'mpeg'))
    {
        exit("Le fichier n'est pas une image");
    } 

    // on copie le fichier dans le dossier de destination
    $name_file = $_FILES['fichier']['name'];
    $ret = move_uploaded_file($tmp_file, $content_dir . $name_file);
    if ($ret != 0)
    {
        print_errors($ret);
        exit("Impossible de copier le fichier dans $content_dir");
    }
    print_errors($ret);
    echo "Le fichier a bien été uploadé";
}

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
?>