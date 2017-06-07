<?php
$title = "test";
include('inc/header.php')
?>

<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<p id="test">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi iste officiis ad distinctio atque sapiente itaque porro eveniet impedit, nihil blanditiis sequi, natus consequatur corrupti dolores nesciunt labore quidem debitis!</p>

			<button class="btn btn-default" id="fucking-btn">GO !</button>
		</div>
	</div>
</div>

<script>
	$('#fucking-btn').click(function(){
		$('#test').text('Mange ma vierge !');
	});

</script>

<?php
include('inc/footer.php')
 ?>
