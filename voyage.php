<?php
  session_start();
  if(!$_SESSION['mdp']){
      header('Location: connexion.php');
  }
  ?>
<!Doctype html>
<html>
    <head>
      <title>Voyage</title>
      <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="voyage.css">
        <link rel="stylesheet" href="inserer_voyage.css">
      <style>
      /* Style pour la page "voyage.php" */

/* Style général pour le corps de la page */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

/* Style pour la bannière en haut de la page */
header {
  background-color: #333;
  color: white;
  padding: 20px;
  text-align: center;
}

/* Style pour les div contenant les informations sur le voyage */
div {
  border: 1px solid #ccc;
  margin: 20px;
  padding: 10px;
}

/* Style pour les titres de sections */
h1, h2 {
  font-size: 24px;
  font-weight: bold;
  margin: 10px;
}

/* Style pour les commentaires */
.commentaires {
  max-height: 300px;
  overflow-y: scroll;
}

.commentaires ul {
  list-style-type: none;
  padding: 0;
}

.commentaires li {
  margin: 10px;
  border: 1px solid #ccc;
  padding: 10px;
}

/* Style pour les liens de suppression des commentaires */
.supprimer {
  color: red;
  cursor: pointer;
}

/* Style pour le formulaire d'ajout de commentaire */
form {
  margin: 20px;
}

form input[type="text"],
form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
}

form input[type="submit"] {
  background-color: #333;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

/* Style pour le texte qui défile */
.texte-defilant {
  overflow: hidden;
  position: relative;
  background-color: #fff;
  color: #333;
  height: 50px;
  font-size: 16px;
  line-height: 50px;
}

.texte-defilant ul {
  list-style: none;
  position: absolute;
  left: 100%;
  top: 0;
  margin: 0;
  padding: 0;
}

.texte-defilant li {
  white-space: nowrap;
  margin: 0;
  padding: 0;
  display: inline-block;
  margin-right: 100%;
  animation: defilement 15s linear infinite;
}

@keyframes defilement {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-100%);
  }
}
</style>
    </head>
    <body>

<?php
include('header.php');
?>


<?php
include('connex.inc.php');
$pdo=connexion('ml05668t');
  // Récupérer le nom du pays dans l'URL
        $nom = $_GET['nom'];
        
        // Recherche des voyages correspondants dans la base de données
        $sql = "SELECT * FROM pays WHERE nom=:nom AND date_debut > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom' => $nom]);
        
        while ($row = $stmt->fetch()) {
            echo "<div>";
            echo "<h1>".$row['nom']."</h1>";
            echo "<p>".$row['presentation']."</p>";
            echo "<p>".$row['prix']."€</p>";
            echo "<p>Depart: ".$row['date_debut']."</p>";
            echo "<p>Retour: ".$row['date_fin']."</p>";
            echo "<a href='page_voyage.php?id_voyage=".$row['id']."'>voir<a>";
            echo "</div>";
        }
        
        $sql2 = "SELECT * FROM commentaire WHERE nom_pays=:nom_pays";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(['nom_pays' => $nom]);
        
        // Afficher les commentaires correspondants
        echo "<h2>Commentaires :</h2>";
        while ($row2 = $stmt2->fetch()) {
            echo "<div>";
            echo "<p>".$row2['pseudo'].":</p>";
            echo "<p> ".$row2['message']."</p>";
            if($_SESSION['statut']==1){       
                echo "<a href='supprimer_commentaire.php?nom=$nom&id=".$row2['id']."'>Supprimer</a>";           
            }
            echo "</div>";
        }
        // Formulaire pour ajouter un commentaire
        echo "<h2>Ajouter un commentaire :</h2>";
        echo "<form method='post' action='ajouter_commentaire.php?nom=$nom'>";
        echo "<input type='text' name='pseudo' placeholder='Pseudo' value='" . $_SESSION['pseudo'] . "' readonly><br>";
        echo "<textarea name='message' placeholder='Votre commentaire' cols='50' rows='20' required></textarea><br>";
        echo "<input type='hidden' name='pays' value='$nom'>";
        echo "<input type='submit' value='Envoyer'>";
        echo "</form>";
            
            
            
        $pdo = null;
include('footer.html');
        ?>
    </body>
</html>