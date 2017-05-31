<?php
$title = "Actualités";
include('header.php');

$stmt = $db->query('SELECT * from newsfeed ORDER BY date DESC');
$score = 42;
?>
<div class="container-fluid">
	<?php
	while ($res=$stmt->fetch()){
		?>
		<div class="row well">
			<div class="col-sm-8">

				<?php
				echo '<h2>'.$res['author'].'</h2>';
				echo '<h3>'.$res['title'].'</h3>';
				echo '<p>'.$res['content'].'</p>';
				echo '<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;'.$score.'&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;';
				echo '<span class="glyphicon glyphicon-thumbs-down"></span>';
				echo '<p class="text-right small">'.$res['date'].'</p>'
				?>
			</div>
		</div>
		<?php
	}
	echo '</div>';
	include('footer.php');
	?>

