<?php
	include("header.php");
	
	function text()
	if(isset($_POST['envoi'])){
		if(!empty($_POST["nom"])){
			$nom=$_POST["nom"];
			if(!empty($_POST["prenom"])){
				$prenom=$_POST["prenom"];
				if(!empty($_POST["mail"])){
					$mail=$_POST["mail"];
					if(!empty($_POST["filiere"])){
						$ecoles=$_POST["ecoles"];
						if(!empty($_POST["message"])){
							$message=$_POST["message"];
							echo "<p>".$prenom.' '.$nom.', merci de nous avoir contacté.</p>';
							echo '<p> votre ecole:'.strtoupper($ecoles).'</p>';
							echo  '<p> votre mail :'.$mail.'</p>';
							echo '<p>Nous répondrons à votre message prochainement. Votrre message:'.$message.'</p>';
							$insertion = $bdd->prepare('INSERT INTO contact VALUES(NULL,"'.$nom.'","'.$prenom.'","'.$mail.'","'.$ecoles.'","'.$message.'")');
							$insertion->execute();
							}
					}
				}
			}
		}
?>
