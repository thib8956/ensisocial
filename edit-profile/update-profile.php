<?php
/**
 * Update the database following a change in the profile.
 */

session_start();
if (!isset($_SESSION['id'])){
	header('Location: /ensisocial/index.php');
}

$title = 'Edit profile';
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/upload.php');

if (isset($_FILES['picture'])){
	echo '<p>Update profile picture</p>';
	updateProfilePicture($db, 'picture');
    header('Location: /ensisocial/edit-profile.php');

// Change password
} elseif (isset($_POST['newpassword'])){
	if (empty($_POST['oldpassword']) or empty($_POST['newpassword']) or empty($_POST['repassword'])){
		// TODO : error messages
        header('Location: /ensisocial/edit-profile.php?pwd=0'); //si pas de valeurs
	} elseif (strlen($_POST['newpassword'])<6){
        header('Location: /ensisocial/edit-profile.php?pwd=1'); //si mdp trop court
    } elseif (updatePassword($db,
			htmlentities($_POST['oldpassword']),
			htmlentities($_POST['newpassword']),
			htmlentities($_POST['repassword'])
			)) // teste si ca change bien
        {
            header('Location: /ensisocial/edit-profile.php?pwd=2');
        } else {
            header('Location: /ensisocial/edit-profile.php?pwd=3');
        }
} elseif (isset($_POST['firstname'])){
    if (empty($_POST['firstname'])){
        header('Location: /ensisocial/edit-profile.php?fn=0');
    } else {
        updateProfile($db, 'firstname', htmlentities($_POST['firstname']));
        $_SESSION['firstname'] = htmlentities($_POST['firstname']);
        header('Location: /ensisocial/edit-profile.php?fn=1');
    }
} elseif (isset($_POST['lastname'])){
    if (empty($_POST['lastname'])){
        header('Location: /ensisocial/edit-profile.php?ln=0');
    } else {
	   updateProfile($db, 'lastname', htmlentities($_POST['lastname']));
        $_SESSION['lastname'] = htmlentities($_POST['lastname']);
        header('Location: /ensisocial/edit-profile.php?ln=1');
    } 
} elseif (isset($_POST['address'])){
	echo '<p>Changement d\'adresse';
	echo '<p>'.$_POST['address'].'</p>';
	updateProfile($db, 'addresse', htmlentities($_POST['address']));
    header('Location: /ensisocial/edit-profile.php?ad=1');
} elseif (isset($_POST['zipcode'])){
	updateProfile($db, 'zipcode', htmlentities($_POST['zipcode']));
    header('Location: /ensisocial/edit-profile.php?zip=1');
} elseif (isset($_POST['town'])){
	updateProfile($db, 'town', htmlentities($_POST['town']));
	$_SESSION['town'] = htmlentities($_POST['town']);
    header('Location: /ensisocial/edit-profile.php?tn=1');
} elseif (isset($_POST['phone'])){
	updateProfile($db, 'phone', htmlentities($_POST['phone']));
    header('Location: /ensisocial/edit-profile.php?tel=1');
} elseif (isset($_POST['birth'])){
    if (empty($_POST['birth'])){
        header('Location: /ensisocial/edit-profile.php?birth=0');
    } else {
        updateProfile($db, 'birth', date('Y-m-d', strtotime($_POST['birth'])));
        $_SESSION['birth']=htmlentities($_POST['birth']);
        header('Location: /ensisocial/edit-profile.php?birth=1');
    }
}


/**
 * Update a field of the table `users` according to a profile change.
 * @param  PDO $pdo    Connection to the database
 * @param  string $field  Name of the field to update
 * @param  $newval New value for this field
 */
function updateProfile($pdo, $field, $newval){
	try {
		$stmt = $pdo->prepare("UPDATE users SET $field = :val WHERE id = :id");
		$stmt->execute(array(
			'val' => $newval,
			'id' => intval($_SESSION['id'])
			));
	} catch (PDOException $e) {
		echo '<div class="alert alert-danger">';
		echo '<p>Error:'.$e.'</p>';
		echo '<p>Exception code :'.$e->getCode().'</p>';
		echo '</div>';
		exit;
	}
}

/**
 * Update the profile picture of an user.
 * @param  PDO $pdo   Connection to the database
 * @param  string $index Index of the file to upload
 */
function updateProfilePicture($pdo, $index){
	// Generate an unique filename for the profile pic.
	$fname = md5(uniqid(rand(), true));
	// Get file extension
	$ext = '.'.substr(strrchr($_FILES['picture']['name'], '.'), 1);
	$dst = $_SERVER['DOCUMENT_ROOT'].'/ensisocial/data/avatar/'.$fname.$ext;

	//echo '<p>'.$fname.'</p>';
	//echo '<p>'.$dst.'</p>';
	// Upload profile picture
	upload($index, $dst);

	// Update profile pic path in the database.
	$stmt = $pdo->prepare('UPDATE users SET profile_pic = :pic_path WHERE id = :id');
	$stmt->execute(array(
		'pic_path' => $fname.$ext,
		'id' => $_SESSION['id']
		));
}

/**
 * Update the password of an user
 * @param  PDO $pdo         Connection to the database.
 * @param  string $oldpassword Actual password of the user.
 * @param  string $newpassword New password.
 * @param  string $repassword  Confirmation of the new password.
 */
function updatePassword($pdo, $oldpassword, $newpassword, $repassword){
	$options = [
	'cost' => 11
	];
	$hash = password_hash($_POST['newpassword'], PASSWORD_BCRYPT, $options); //hashage du mdp

	// Verify old password
	$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
	$stmt->execute(array('email'=> htmlentities($_SESSION['email'])));
	$row = $stmt->fetch();
	if (password_verify($_POST['oldpassword'], $row['password'])){
	    if ($_POST['newpassword']==$_POST['repassword']){
	        $stmt= $pdo->prepare('UPDATE users SET password=:hash WHERE id=:id');
	        $stmt->execute(array('hash'=>$hash,
	            'id'=> intval($_SESSION['id'])));
            return true;
	    }
	}
    return false;
}
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
