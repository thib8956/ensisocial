<?php
session_start();
$title = 'Chat';
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');
try {
	/* Fetch profile picture */
	$profile  = $db->query('SELECT profile_pic from users WHERE id='.$_SESSION['id']);
	$data = $profile->fetch();
	if (!empty($data['profile_pic'])){
		$pic_path = '/ensisocial/data/avatar/'.$data['profile_pic'];
	} else {
		$pic_path = 'data/default-profile.png';
	}

} catch (PDOException $e) {
	echo '<div class="alert alert-danger">';
	die('Error:'.$e->getMessage());
	echo '</div>';
}
?>

<?php
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<style type="text/css">

input[type=text]{
		width:100%;
		margin-top:5px;

	}


.chat_wrapper {
	width: 70%;
	height:472px;
	background: #3B5998;
	border: 1px solid #999999;
	padding: 10px;
	font: 14px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .message_box {
	background: #F7F7F7;
	height:350px;
		overflow: auto;
	padding: 10px 10px 20px 10px;
	border: 1px solid #999999;
}
.chat_wrapper  input{
	//padding: 2px 2px 2px 5px;
}
.system_msg{color: #BDBDBD;font-style: italic;}
.user_name{font-weight:bold;}
.user_message{color: #88B6E0;}

@media only screen and (max-width: 720px) {
/* For mobile phones: */
.chat_wrapper {
width: 95%;
height: 40%;
}


.button { 
width:100%;
margin-right:auto;
margin-left:auto;
height:40px;
}






}
</style>
<div class="row">
	<div class="col-sm-2 well affix">
		<center>
			<a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src=<?php echo $pic_path ?> name="aboutme" width="140" height="140" class="img-circle img-responsive"></a>
			<h3>
				<?php
				echo $_SESSION['firstname'].' '.$_SESSION['lastname'];
				?>
			</h3>
		</center>
		<!-- List of connected members. -->
		<p>Autres membres : </p>
		<div id="memberconnected">Membres</div>
	</div>
</div>

<div class="row">
    <div class="col-sm-offset-2 col-md-9 chat_wrapper">
        <div class="message_box" id="message_box"></div>
            <div>
                <input type="text" name="message" id="message" placeholder="Message" maxlength="80"
                onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()" class="form-control ui-autocomplete-input" />
            </div>
        <button id="send-btn" class="btn btn-primary">Send</button>
    </div>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
