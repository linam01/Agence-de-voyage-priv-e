<?php
  session_start();
  if(!$_SESSION['mdp']){
      header('Location: connexion.php');
  }
  echo  $_SESSION['pseudo'];
  
  include('connex.inc.php');
  $pdo=connexion('ml05668t');
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8">
	<title>Formulaire de contact</title>
    </head>
    <body>
      <?php include("header.php");?>
      	<h1>Formulaire de contact</h1>

        <?php  
        // Récupérer les données saisies dans le formulaire
        $nom_complet = $_POST["nom_complet"];
        $objet = $_POST["objet"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $numero = $_POST["numero"];
        $date = $_POST["date"];
        $autre_details = $_POST["autre_details"];
        
        // Valider et nettoyer les données
        $nom_complet = htmlspecialchars($nom_complet);
        $objet = htmlspecialchars($objet);
        $email = htmlspecialchars($email);
        $message = htmlspecialchars($message);
        $numero = htmlspecialchars($numero);
        $date = htmlspecialchars($date);
        $autre_details = htmlspecialchars($autre_details);
        
        // Préparer la requête SQL
        $stmt = $pdo->prepare("INSERT INTO contact (nom_complet, objet, email, message, numero, date, autre_details) VALUES (:nom_complet, :objet, :email, :message, :numero, :date, :autre_details)");
        
        // Lier les paramètres à la requête SQL
        $stmt->bindParam(':nom_complet', $nom_complet);
        $stmt->bindParam(':objet', $objet);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':autre_details', $autre_details);
        
        // Exécuter la requête SQL
        $stmt->execute();
        
        // Fermer la connexion à la base de données
        $pdo= null;
        ?>
        <p>Votre message a été envoyé avec succès.</p>
        <a href="index.php">Retour à la page d'accueil</a>
        <?php include("footer.html"); ?>
        
    </body>
</html>
