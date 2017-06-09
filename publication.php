<?php
/**
 * Page de création d'une publication dans le newsfeed.
 */

session_start();
$title=$_SESSION['firstname'];
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

if(isset($_POST['post'])){
	if (!empty($_POST['title']) && !empty($_POST['content'])){
		createPublication($db);
		if($_POST["idplace"]==NULL){
			header('Location: page_membre.php');
		}elseif($_POST["type"]==0){
			header('Location: recherche/searchProfil.php?id='.$_POST["idplace"]);
		}else{
			header('Location: group/groupPage.php?id='.$_POST["idplace"]);

		}
	}
}


function createPublication($conn){
	$curr_timestamp = date('Y-m-d H:i:s');
	try {
		$stmt = $conn->prepare('INSERT INTO `newsfeed` (`title`, `date`, `content`,`place`,`type`) VALUES (:title, :date, :content, :place, :type)');
		$stmt->execute(array(
			'title' => htmlentities($_POST['title']),
			'date' => $curr_timestamp,
			'content' => htmlentities($_POST['content']),
			'place' => intval($_POST['idplace']),
			'type' => intval($_POST['type'])
			));
		$stmt = $conn->prepare('INSERT INTO `authornews` (`authorid`, `newsfeedid`)
			VALUES (:author_id, (SELECT id FROM newsfeed WHERE `date` = :date AND `title` = :title))');
		$stmt->execute(array(
			'date' => $curr_timestamp,
			'author_id' => $_SESSION['id'],
			'title' => htmlentities($_POST['title'])
			));

	} catch (PDOException $e) {
		echo '<div class="alert alert-danger">';
		die('Error:'.$e->getMessage());
		echo '</div>';
	}
}

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
