<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}
$title="change_password";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
	$options = [
          'cost' => 11
        ];
    $hash = password_hash($_POST['newpassword'], PASSWORD_BCRYPT, $options); //hashage du mdp

//Partie de traitement
    $req = $db->prepare('SELECT * FROM users WHERE email = :email');
    $req->execute(array('email'=> $_SESSION['email']));
    $row = $req->fetch(); //On récupère les infos
    if (password_verify($_POST['oldpassword'], $row['password'])){
        if ($_POST['newpassword']==$_POST['repassword']){
            $req2= $db->prepare('UPDATE users SET password="'.$hash.'" WHERE id='.$_SESSION['id']);
            $req2->execute();
        }
    }
// messages d'alerte à rajouter quand c'est pas les bons, mettre que c'est bien changé sinon

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
header('Location: /ensisocial/edit-profile.php');
?>
