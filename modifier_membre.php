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
    <title>Insertion</title>
         <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="inserer_voyage.css">
  </head>
  <body> 
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
      <h1> Modifier un membre</h1>
      <?php
      session_start();
      if (isset($_GET['id'])) {
          $id = intval($_GET['id']);
          include('connex.inc.php');
          $pdo = connexion('ml05668t');
          try {
              $stmt = $pdo->prepare('SELECT * FROM membre WHERE id = :id');
              $stmt->bindParam(':id',$id);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if (count($results) > 0) {
                  $result = $results[0];
      ?>
       <form action="enregistrer.php" method="POST" class="form_voyage" >
         <label>pseudo : </label><input type="text" name="pseudo" value="<?php echo $result['pseudo']; ?>"><br>
          <label>Nom : </label><input type="text" name="nom" value="<?php echo $result['nom']; ?>"><br>
           <label>Prenom :</label> <input type="text" name="prenom" value="<?php echo $result['prenom']; ?>"><br>
           <label>Email : </label><input type="email" name="email" value="<?php echo $result['email']; ?>"><br>
          
           <select name="statut" required>
               <option value="0">Membre</option>
               <option value="1">Administrateur</option>
           </select>
           
           
           <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
           
           <br>
           <button type="submit"class="button_ajouter" >Modifier</button>
    </form>
      <?php
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
     <?php include('footer.html');?>
  </body>
</html>












