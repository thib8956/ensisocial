<?php
include("header.php");
?>
<!--First Name -->
<form action="traitement.php">
<div class="field clearfix">
	<label for="first_name"> prenom </label>
	<input type="text" name="first_name" id="First_Name">
	<span class="error-message"></span>
</div>

<!-- First Name / End -->

<!-- Second Name -->
<div class="field clearfix">
	<label for="Secondname"> Deuxième prenom </label>
	<input type="text" name="Secondname" id="Second_Name">
</div>

<!-- Second Name / End -->                                        

<!-- Last Name -->
<div class="field clearfix">
	<label for="name">nom </label>
	<input type="text" name="lastname" id="last_Name">
	<span class="error-message"></span>
</div>
<!-- Last Name / End -->

<!-- Address -->
<div class="field clearfix">
	<label for="adresse">Adresse </label>
	<input type="text" name="adresse" id="adresse" placeholder="">
	<span class="error-message"></span>
</div>
<!-- Address / End -->


<!-- Email -->
<div class="field clearfix">
	<label for="email">Email </label>
	<input type="email" name="email" id="email">
	<span class="error-message"></span>
</div>
<!-- Email / End -->

<!-- Telephone 1 -->
<div class="field clearfix">
	<label for="phone">Telephone </label>
	<input type="text" name="phone" id="phone" placeholder="">
	<span class="error-message"></span>
</div>
<!-- Telephone 1 / End -->



<!-- Password -->
<div class="field clearfix">
	<label for="password">Mot de Passe </label>
	<input type="password" name="password" id="password">
	<span class="error-message"></span>
</div>
<!-- Password / End -->

<!-- Re-Password -->
<div class="field clearfix">
	<label for="repassword">Retapez votre Mot de Passe </label>
	<input type="password" name="repassword" id="repassword">
	<span class="error-message"></span>
</div>
<!-- Re-Password / End -->

<!--Filière>-->
<div calss="field clearfix">
	
	<select name="filiere" >
		<option value="IR">Informatique et réseau</option>
		<option value="AS">Automatique et Système</option>
		<option value="meca">Mecanique</option>
		<option value="textile">Textile</option>
		<option value="FIP">filière par alternance</option>
	</select>
</div>
<!-- Filière / End -->

<!-- -age -->
<div class="field clearfix">
	<label for="Birthday">Date de naissance  </label>
	<input type="date" name="Birthday" id="Birthday">
	<span class="error-message"></span>
</div>
<!-- -age / End -->





</div>
</div>



<input type="submit" value="S'inscrire!" class="button__large" name="submit" id="submit">

</form>

<?php
include("footer.php");
?>