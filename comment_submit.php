<?php
session_start();
$title = $_SESSION['firstname'];
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

if (!empty($_POST['add'])){
	createComment($db);
	//header('Location: '.$_POST["back"]);
} else {
    //header('Location: '.$_POST["back"]);
}

function createComment($conn){
	$content = htmlentities($_POST['add']);
	$post_id = $_POST['post_id'];
	$curr_timestamp = date('Y-m-d H:i:s');

	try {
		$stmt = $conn->prepare('INSERT INTO comments (`content`, `date`)
			VALUES (:content, :date)');
		$stmt->execute(array('content' => $content, 'date' => $curr_timestamp));

		$stmt = $conn->prepare('INSERT INTO authorcomment (`authorid`, `commentid`) VALUES (:authorid, (SELECT id FROM comments WHERE `date` = :date))');
		$stmt->execute(array('authorid' => $_SESSION['id'],
			'date' => $curr_timestamp));

		$stmt = $conn->prepare('INSERT INTO newscomment (`newsfeedid`, `commentid`) VALUES (:newsfeedid, (SELECT id FROM comments WHERE `date` = :date))');
		$stmt->execute(array('newsfeedid' => $post_id,
			'date' => $curr_timestamp));
	} catch (PDOException $e) {
		echo '<div class="alert alert-danger">';
		die('Error:'.$e->getMessage());
		echo '</div>';
	}
}

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
