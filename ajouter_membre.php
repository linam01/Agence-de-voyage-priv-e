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
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="enregistrer.css">                                       
  </head>
  <body>
<?php
      include('header.php');
      include('menu-admin.php');
                         ?>                    
         <div class="enregistrer">                                    
      <h1>Inserer un membre</h1>
     <?php
    if (isset($_POST['pseudo']) && isset($_POST['statut']) && isset($_POST['mdp'])) {
          $statut = $_POST['statut'];
          $pseudo = $_POST['pseudo'];
          $mdp = md5($_POST['mdp']);
          
          include('connex.inc.php');
          $pdo = connexion('ml05668t');
          try {
              $stmt = $pdo->prepare('INSERT INTO membre (pseudo,statut,mdp) VALUES(:pseudo, :statut, :mdp)');
              $stmt->bindParam(':pseudo', $pseudo);
              $stmt->bindParam(':statut', $statut);
              $stmt->bindParam(':mdp', $mdp);

              $stmt->execute();

              if ($stmt->rowCount() == 1) {
                  echo '<p>Ajout effectué</p>';
      echo '<a href="inserer_membre.php">inserer un nouveau membres</a><br/>';
      echo '<a href="liste_membres.php">Afficher la lste des membres</a>';


                  
              } else {
                  echo '<p>Erreur ajout</p>';
              }
              $stmt->closeCursor();
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
      <?php include('footer.html');?>
      
  </body>
</html>
      