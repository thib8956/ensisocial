<?php
$title="Accueil";
include('inc/header.php');

?>

<form action="connectiontraitement.php" method="post" accept-charset="utf-8" class="form-inline">
  <div class="imgcontainer">
    <img src="img/ensisocial.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Entrer votre mail" name="email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Password" name="pwd" required>

    <button type="submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me
  </div>

  <div class="container" style="background-color:LightBlue">
    <span class="pwd">Forgot <a href="lost_pwd.php">password?</a></span>
  </div>
</form> 

<?php
include('inc/footer.php');
?>
