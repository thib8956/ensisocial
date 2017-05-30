<?php
$title="Inscription";
include("header.php");
?>
<div class="bootstrap-iso">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form action="traitement.php" method="post">

					<!-- username -->
					<div class="form-group">
						<label for="username" class="control-label">Nom d'utilisateur<span class="asteriskField">*</span></label>
						<input type="text" name="username" class="form-control">
					</div>
					<!-- username / End -->

					<!-- password -->
					<div class="form-group">
						<label for="password" class="control-label">Mot de Passe<span class="asteriskField">*</span></label>
						<input type="password" name="password" class="form-control">
						<span class="error-message"></span>
					</div>
					<!-- password / End -->

					<!-- repassword -->
					<div class="form-group">
						<label for="repassword" class="control-label">Retapez votre Mot de Passe<span class="asteriskField">*</span></label>
						<input type="password" name="repassword" class="form-control">
						<span class="error-message"></span>
					</div>
					<!-- repassword / End -->

					<!--firstname -->

					<div class="form-group">
						<label for="firstname" class="control-label">Prenom</label>
						<input type="text" name="firstname" class="form-control">
					</div>

					<!-- firstame / End -->

					<!-- secondname -->
					<div class="form-group">
						<label for="secondname" class="control-label"> Deuxième prenom </label>
						<input type="text" name="secondname" class="form-control">
					</div>

					<!-- secondname / End -->

					<!-- lastname -->
					<div class="form-group">
						<label for="lastname" class="control-label">Nom </label>
						<input type="text" name="lastname" class="form-control">
					</div>
					<!-- lastname / End -->

					<!-- address -->
					<div class="form-group">
						<label for="address" class="control-label">Adresse</label>
						<input type="text" name="address" class="form-control">
					</div>
					<!-- address / End -->

					<!-- zipcode -->
					<div class="form-group">
						<label for="zipcode" class="control-label">code postal</label>
						<input type="text" name="zipcode" class="form-control">
					</div>
					<!-- zipcode / End -->

					<!-- town -->
					<div class="form-group">
						<label for="town" class="control-label">Ville</label>
						<input type="text" name="town" class="form-control">
					</div>
					<!-- town / End -->

					<!-- birth -->
					<div class="form-group">
						<label for="birth" class="control-label">Date de naissance</label>
						<input type="date" name="birth" class="form-control">
					</div>
					<!-- birth / End -->


					<!-- email -->
					<div class="form-group">
						<label for="email" class="control-label">Email<span class="asteriskField">*</span></label>
						<input type="email" name="email" class="form-control">
					</div>
					<!-- email / End -->

					<!-- phone -->
					<div class="form-group">
						<label for="phone" class="control-label">Telephone </label>
						<input type="text" name="phone" class="form-control">
					</div>
					<!-- phone / End -->

					<!--formation>-->
					<div class="form-group">
						<label for="formation" class="control-label"></label>
						<select name="formation" class="form-control">
							<option value="IR">Informatique et réseau</option>
							<option value="AS">Automatique et Système</option>
							<option value="meca">Mecanique</option>
							<option value="textile">Textile</option>
							<option value="FIP">filière par alternance</option>
						</select>
					</div>
					<!-- formation / End -->

					<div class="form-group"> <!-- Submit button !-->
						<button type="submit" class="btn btn-primary">S'inscrire !</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>
