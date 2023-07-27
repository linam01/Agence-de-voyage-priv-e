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
        <title>Membres</title>
        <link  rel="stylesheet" href="style.css">
                <link rel="stylesheet" href="liste_membres.css">                              
    </head>
    <body>
        <?php
        include('header.php');
  include('menu-admin.php');
        ?>
        <div class="liste-membres">
        <h1> Liste des membres</h1>
        <?php
        include('connex.inc.php');
        $pdo=connexion('ml05668t');
        $recupMembre = $pdo->query("SELECT * FROM membre");
        echo "<table>";
echo "<thead><tr><th>Pseudo</th><th>Statut</th><th>Action</th></tr></thead>";
echo "<tbody>";
while ($membre = $recupMembre->fetch()) {
    echo "<tr>";
    echo "<td>" . $membre['pseudo'] . "</td>";
    echo "<td class='center' >" . $membre['statut'] . "</td>";
    echo "<td class='center'><a href='supprimer_membre.php?id=" . $membre['id'] . "'>Supprimer</a>  <a href='modifier_membre.php?id=" . $membre['id'] . "'>Modifier</a></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
          
        ?>
</div>
<?php include('footer.html');   ?>
        
    </body>
</html>

