<?php
  session_start();
  if(!$_SESSION['mdp'] && $_SESSION['statut'!=1] ){
     header('Location: connexion.php');
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>Modifier voyage</title>
    <link rel="stylesheet" href="style.css">
             <link rel="stylesheet" href="inserer_voyage.css">
  </head>
  <body> 
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
      <h1>Modifier un voyage</h1>
      
      <?php
      session_start();
      if (isset($_GET['id'])) {
          $id = intval($_GET['id']);
          include('connex.inc.php');
          $pdo = connexion('ml05668t');
          try {
              $stmt = $pdo->prepare('SELECT * FROM pays WHERE id = :id');
              $stmt->bindParam(':id',$id);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if (count($results) > 0) {
                  $result = $results[0];
   ?>
          
          <form action="enregistrer_voyage.php" method="post"class="form_voyage" >
              <label>Nom :</label> <input type="text" name="nom" value="<?php echo $result['nom']; ?>"><br>
              <label>Prix :</label> <input type="text" name="prix" value="<?php echo $result['prix']; ?>"><br/>
              <label>Date debut :</label> <input type="date" name="date_debut" value="<?php echo $result['date_debut']; ?>"><br/>
              <label>Date fin :</label> <input type="date" name="date_fin" value="<?php echo $result['date_fin']; ?>"><br/>   
              <input type="hidden" name="id" value="<?php echo $result['id']; ?>" ><br>
               <label>Image : </label><input type="text" name="image" value="<?php echo $result['image']; ?>">
               <br>
                <label>Prensentation :</label><textarea name="presentation" rows="4" cols="40"><?php echo $result['presentation']; ?></textarea><br/>
               <button type="submit" class="button_ajouter">Modifier</button>
          </form>
      <?php
   } else {
       echo '<p>Restaurant non trouvée</p>';
      }
      $stmt->closeCursor();
      $pdo = null;
   } catch (PDOException $e) {
       echo 'Erreur PDO';
       echo $e->getMessage();
      }
      
   } else {
       echo "<p>Mauvais paramètre</p>";
      }
      
      ?>
      <?php include('footer.html'); ?>
  </body>
</html>