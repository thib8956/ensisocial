<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="Changer la photo";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/upload.php');

// Generate an unique filename for the profile pic.
$fname = md5(uniqid(rand(), true));
$ext = '.'.substr(strrchr($_FILES['picture']['name'], '.'), 1); // Get file extension
$dst = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/avatar/'.$fname.$ext;
// Upload profile picture
upload('picture', $dst);

/* Update profile pic path in the database. */
$stmt = $db->prepare('UPDATE users SET profile_pic = :pic_path WHERE id = :id');
$stmt->execute(array(
	'pic_path' => $fname.$ext,
	'id' => $_SESSION['id']
	));


include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
