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
    <title>Voyage</title>
       <link rel="stylesheet" href="style.css"> 
       <link rel="stylesheet" href="liste_membres.css">
  </head>
  <body>
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
<div class="liste-voyage">
      <h1>Liste voyage</h1>
      <?php 
      include('connex.inc.php');
      $pdo=connexion('ml05668t');
      $recupVoyage = $pdo->query("SELECT * FROM pays");
        echo "<table>";
  echo "<thead><tr><th>Nom</th><th>Présentation</th><th>Date de début</th><th>Date de fin</th><th>Prix</th><th>Action</th></tr></thead>";
  echo "<tbody>";
     while ($voyage = $recupVoyage->fetch()) {
    echo "<tr>";
    echo "<td>" . $voyage['nom'] . "</td>";
    echo "<td>" . $voyage['presentation'] . "</td>";
    echo "<td>" . $voyage['date_debut'] . "</td>";
    echo "<td>" . $voyage['date_fin'] . "</td>";
    echo "<td>" . $voyage['prix'] . " euros" . "</td>";
    echo "<td><a href='supprimer_voyage.php?id=" . $voyage['id'] . "'>Supprimer</a> <a href='modifier_voyage.php?id=" . $voyage['id'] . "'>Modifier</a></td>";
    echo "</tr>";}
        echo "</tbody>";
  echo "</table>";
?>
</div>
<?php 
      include('footer.html');
      ?>
  </body>
</html>