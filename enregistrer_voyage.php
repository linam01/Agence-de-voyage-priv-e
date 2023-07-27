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
    <title>Modification Voyage</title>
  /*  <link rel="stylesheet" href="style.css">    */
    <link rel="stylesheet" href="enregistrer.css">                                 
  </head>
  <body>
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
<div class="enregistrer">
      <h1>Modifcation voyage</h1>

       <?php
       if (isset($_POST['nom']) && isset($_POST['presentation']) && isset($_POST['date_fin']) && isset($_POST['date_debut']) && isset($_POST['prix']) && isset($_POST['image'])){
            $id =$_POST['id'];
          $nom = $_POST['nom'];
          $presentation = $_POST['presentation'];
          $date_debut = $_POST['date_debut'];
          $date_fin = $_POST['date_fin'];
          $prix=$_POST['prix'];
            $nb_jours = ceil((strtotime($date_fin) - strtotime($date_debut)) / 86400);            
            $image=$_POST['image'];
          include('connex.inc.php');
          $pdo = connexion('ml05668t');
              try {
        $stmt = $pdo->prepare('UPDATE pays SET nom=:nom, presentation=:presentation, prix=:prix, date_debut=:date_debut, date_fin=:date_fin, image=:image, nb_jours=:nb_jours WHERE id=:id');
                  $stmt->bindParam(':nom', $nom);
                  $stmt->bindParam(':presentation', $presentation);
                  $stmt->bindParam(':prix', $prix);
                  $stmt->bindParam(':date_debut', $date_debut);
                  $stmt->bindParam(':date_fin', $date_fin);
                  $stmt->bindParam(':id', $id);
                  $stmt->bindParam(':image', $image);
                  $stmt->bindParam(':nb_jours',$nb_jours);
                  $stmt->execute();
          
                  if ($stmt->rowCount() == 1) {
              echo '<p>Modification effectuée</p>';
                      echo '<a href="liste_voyage.php">Retour</a>';

                      
              } else {
                  echo '<p>Acune modification faite </p>';
                  echo '<a href="liste_voyage.php">Retour</a>';
                     
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
      <?php include('footer.html');
      ?>
  </body>
</html>