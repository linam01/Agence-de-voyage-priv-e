<?php
session_start();
include('connex.inc.php');
$pdo=connexion('ml05668t');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

  if (isset($_GET['id'])) {
      $id = intval($_GET['id']);
          try {
              $stmt = $pdo->prepare('DELETE FROM membre WHERE id = :id');
              $stmt->bindParam(':id',$id);
              $stmt->execute();
             
              $stmt->closeCursor();
              $pdo = null;
              header('Location: liste_membres.php');
          } catch (PDOException $e) {
              echo 'Erreur PDO';
              echo $e->getMessage();
          }
  } else {
      echo "<p>Mauvais paramètre</p>";
  }
?>
  