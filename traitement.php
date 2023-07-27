<?php
if(isset($_POST['nom']) && isset($_POST['email'])) {
	$nom = $_POST['nom'];
	$email = $_POST['email'];

	// Traitement des données ici...

	echo "Merci $nom, votre adresse email est $email.";
}
?>