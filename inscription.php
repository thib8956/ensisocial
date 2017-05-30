<?php
$title="Inscription";
include("header.php");
?>
<form action="traitement.php" method="post">

	<!-- username -->
	<div class="field clearfix">
		<label for="username">Nom d'utilisateur </label>
		<input type="text" name="username" id="User_Name">
		<span class="error-message"></span>
	</div>
	<!-- username / End -->

	<!-- password -->
	<div class="field clearfix">
		<label for="password">Mot de Passe </label>
		<input type="password" name="password" id="password">
		<span class="error-message"></span>
	</div>
	<!-- password / End -->

	<!-- repassword -->
	<div class="field clearfix">
		<label for="repassword">Retapez votre Mot de Passe </label>
		<input type="password" name="repassword" id="repassword">
		<span class="error-message"></span>
	</div>
	<!-- repassword / End -->

	<!--firstname -->

	<div class="field clearfix">
		<label for="firstname"> Prenom </label>
		<input type="text" name="firstname" id="First_Name">
		<span class="error-message"></span>
	</div>

	<!-- firstame / End -->

	<!-- secondname -->
	<div class="field clearfix">
		<label for="secondname"> Deuxième prenom </label>
		<input type="text" name="secondname" id="Second_Name">
		<span class="error-message"></span>
	</div>

	<!-- secondname / End -->                                        

	<!-- lastname -->
	<div class="field clearfix">
		<label for="lastname">Nom </label>
		<input type="text" name="lastname" id="Last_Name">
		<span class="error-message"></span>
	</div>
	<!-- lastname / End -->

	<!-- address -->
	<div class="field clearfix">
		<label for="address">Adresse</label>
		<input type="text" name="address" id="address" placeholder="">
		<span class="error-message"></span>
	</div>
	<!-- address / End -->

	<!-- zipcode -->
	<div class="field clearfix">
		<label for="zipcode">code postal</label>
		<input type="text" name="zipcode" id="zipcode" placeholder="">
		<span class="error-message"></span>
	</div>
	<!-- zipcode / End -->

	<!-- town -->
	<div class="field clearfix">
		<label for="town">Ville</label>
		<input type="text" name="town" id="town" placeholder="">
		<span class="error-message"></span>
	</div>
	<!-- town / End -->

	<!-- birth -->
	<div class="field clearfix">
		<label for="birth">Date de naissance  </label>
		<input type="date" name="birth" id="birth">
		<span class="error-message"></span>
	</div>
	<!-- birth / End -->


	<!-- email -->
	<div class="field clearfix">
		<label for="email">Email </label>
		<input type="email" name="email" id="email">
		<span class="error-message"></span>
	</div>
	<!-- email / End -->

	<!-- phone -->
	<div class="field clearfix">
		<label for="phone">Telephone </label>
		<input type="text" name="phone" id="phone" placeholder="">
		<span class="error-message"></span>
	</div>
	<!-- phone / End -->

	<!--formation>-->
	<div calss="field clearfix">

		<select name="formation" >
			<option value="IR">Informatique et réseau</option>
			<option value="AS">Automatique et Système</option>
			<option value="meca">Mecanique</option>
			<option value="textile">Textile</option>
			<option value="FIP">filière par alternance</option>
		</select>
	</div>
	<!-- formation / End -->

</div>
</div>



<input type="submit" value="S'inscrire!" class="button__large" name="signin" id="submit">

</form>

<?php
include("footer.php");
?>