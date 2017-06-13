<?php
/**
 * Functions to upload a file on the server.
 */

/**
 * Upload a profile picture to the server.
 * @param  string  $index       Name of the input field : $_FILES[$index]
 * @param  string  $destination Destination path.
 * All profile pictures are stored in /ensisocial/data/avatars
 */
function upload($index, $destination, $maxsize=FALSE, $extensions=FALSE){
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    // Test max file size
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    // Check whether the file has a valid extension.
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    $ret = move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
    return $ret;
}


/**
 * Print error messages according to move_upload_file() return codes.
 * cf. http://www.php.net/manual/en/features.file-upload.errors.php
 * @param  int $retcode return code of move_upload_file().
 */
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
