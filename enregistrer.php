<?php
  session_start();
  if(!$_SESSION['mdp'] && $_SESSION['statut'!=1] ){
     header('Location: connexion.php');
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Modification</title>
     <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="enregistrer.css">
  </head>
  <body>
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
<div class="enregistrer">
      <h1>Modification membre</h1>
      <?php
      if(isset($_POST['pseudo'],$_POST['statut'])){
              $id =$_POST['id'];
              $pseudo = $_POST['pseudo'];
              $statut = $_POST['statut'];
              $email=$_POST['email'];
              $nom=$_POST['nom'];
              $prenom=$_POST['prenom'];
              include('connex.inc.php');
              $pdo = connexion('ml05668t');
              try {
                  $stmt = $pdo->prepare('UPDATE membre SET pseudo=:pseudo, statut=:statut WHERE id=:id');
                  $stmt->bindParam(':id', $id);
                  $stmt->bindParam(':pseudo', $pseudo);
                  $stmt->bindParam(':statut', $statut);
                  $stmt->bindParam(':nom', $nom);
                  $stmt->bindParam(':prenom', $prenom);
                  $stmt->bindParam(':email', $email);
                  
                  
                  $stmt->execute();
          
                  if ($stmt->rowCount() == 1) {
              echo '<p>Modification effectuée</p>';
                  echo '<a href="liste_membres.php">Retour</a>';
              } else {
                      echo '<p>Erreur : '.$stmt->errorInfo()[2].'</p>';
                     
              }
      } catch(PDOException $e) {
          echo '<p>Problème PDO</p>';
          echo $e->getMessage();
      }
      $stmt->closeCursor();
          $pdo = null;
      } else {
          echo "<p>Mauvais paramètres</p>";
      }?>
</div>
      <?php
      include('footer.html');
      ?>
  </body>
</html>