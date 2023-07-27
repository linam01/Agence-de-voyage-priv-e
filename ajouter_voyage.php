<?php
session_start();
if (!$_SESSION['mdp'] && $_SESSION['statut'] != 1) {
    header('Location: connexion.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>Insertion</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="enregistrer.css">
  </head>
  <body> 
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
<div class="enregistrer">

      <h1>Ajouter un voyage</h1>

      <?php
      if (isset($_POST['nom']) && isset($_POST['presentation']) && isset($_POST['date_fin']) && isset($_POST['date_debut']) && isset($_POST['prix']) && isset($_POST['image'])){
          $nom = $_POST['nom'];
          $presentation = $_POST['presentation'];
          $date_debut = $_POST['date_debut'];
          $date_fin = $_POST['date_fin'];
          $prix=$_POST['prix'];
          $image=$_POST['image'];
          $nb_jours = ceil((strtotime($date_fin) - strtotime($date_debut)) / 86400);

          include('connex.inc.php');
          $pdo = connexion('ml05668t');
          try {
              $stmt = $pdo->prepare('INSERT INTO pays (nom,presentation,prix,date_debut,date_fin,image,nb_jours) VALUES(:nom, :presentation, :prix, :date_debut, :date_fin, :image, :nb_jours)');
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':presentation', $presentation);
              $stmt->bindParam(':prix', intval($prix));
              $stmt->bindParam(':date_debut', $date_debut);
              $stmt->bindParam(':date_fin', $date_fin);
              $stmt->bindParam(':nb_jours', intval($nb_jours));
              $stmt->bindParam(':image',$image);
              $stmt->execute();
              $stmt->closeCursor();
              
              if ($stmt->rowCount() == 1) {
          echo '<p>Ajout effectué</p>';
          $id_pays = $pdo->lastInsertId(); // Récupérer l'ID du pays inséré
                  
          // Ajouter les jours pour ce pays
          echo '<form action="ajouter_jours.php" method="post">';
          for ($i=1; $i <= $nb_jours; $i++) {
              echo '<label>Jour '.$i.' :<textarea rows="10" cols="10" name="descriptif_'.$i.'"></textarea></label><br/>';
              
          }
          echo '<input type="hidden" name="id_pays" value="'.$id_pays.'">';
          echo '<input type="hidden" name="nb_jours" value="'.$nb_jours.'">';
                  echo '<button type="submit">Ajouter jours</button>';
          echo '</form>';
          
      echo '<a href="inserer_voyage.php">inserer un nouveau voyage</a><br/>';
          echo '<a href="liste_voyage.php">Afficher la liste des voyage</a>';
      } else {
          echo '<p>Erreur ajout</p>';
      }
              $pdo = null;
          } catch (PDOException $e) {
              echo 'Erreur PDO';
              echo $e->getMessage();
          }
      } else {
          echo '<p>Mauvais paramètre</p>';
      }
        ?>
      </div>

         <?php
    include('footer.html');
        ?>
         

  </body>
</html>