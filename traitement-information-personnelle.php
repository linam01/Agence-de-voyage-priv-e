<?php 
session_start();
if(!isset($_SESSION['mdp'])){
    header('Location: connexion.php');
}
include('connex.inc.php');
$pdo = connexion('ml05668t');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>Informations</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php
        include("header.php");
      if($_SESSION['statut']==1){
          include("menu-admin.php");
      }else{
          include("menu-membre.php");
      }
$id = $_SESSION['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $cp = $_POST['cp'];

    if(!empty($nom) && !empty($prenom) && !empty($email)) {
        try {
            $stmt = $pdo->prepare("UPDATE membre SET nom=:nom, prenom=:prenom, email=:email, adresse=:adresse, ville=:ville, cp=:cp WHERE id=:id");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':cp', $cp);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            echo "<p class='text'>Informations enregistrées avec succès.</p>";
        } catch(PDOException $e) {
            echo "<p class='text'>Erreur lors de l'exécution de la requête SQL :</p> ".$e->getMessage();
        }
    } else {
        echo "Les champs nom, prénom et email sont obligatoires.";
    }
}

    include("footer.html");
?>
</body>
</html>