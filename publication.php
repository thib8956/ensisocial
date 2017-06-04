<?php
/**
 * Page de création d'une publication dans le newsfeed.
 */

session_start();
$title = $_SESSION['firstname'];
include_once('inc/header.php');

if(isset($_POST['post'])){
	if (!empty($_POST['title']) && !empty($_POST['content'])){
		createPublication($db);
		header('Location: page_membre.php');
	}
}

function createPublication($conn){
	$curr_timestamp = date('Y-m-d H:i:s');
	try {
		$stmt = $conn->prepare('INSERT INTO `newsfeed` (`title`, `date`, `content`) VALUES (:title, :date, :content)');
		$stmt->execute(array(
			'title' => $_POST['title'],
			'date' => $curr_timestamp,
			'content' => $_POST['content']
			));

		$stmt = $conn->prepare('INSERT INTO `authornews` (`authorid`, `newsfeedid`)
			VALUES (:author_id, (SELECT id FROM newsfeed WHERE `date` = :date AND `title` = :title))');
		$stmt->execute(array(
			'date' => $curr_timestamp,
			'author_id' => $_SESSION['id'],
			'title' => $_POST['title']
			));

	} catch (PDOException $e) {
		echo '<div class="alert alert-danger">';
		die('Error:'.$e->getMessage());
		echo '</div>';
	}
}

include_once('inc/footer.php');
?>
