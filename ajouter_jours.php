<?php
session_start();
if (!$_SESSION['mdp'] && $_SESSION['statut'] != 1) {
    header('Location: connexion.php');
}
include('header.php');
include('menu-admin.php');
include('connex.inc.php');
$pdo = connexion('ml05668t');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Ajouter des jours</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="enregistrer.css">
    </head>
<body>
  <div class="enregistrer">
        <h1>Ajouter des jours</h1>
    <?php
        if (isset($_POST['id_pays']) && isset($_POST['nb_jours'])) {    
        $id_pays = $_POST['id_pays'];
        $nb_jours = $_POST['nb_jours'];  
        echo '<form method="post" action="enregistrer_jours.php">';
        for ($i = 1; $i <= $nb_jours; $i++) {
        $descriptif = isset($_POST['descriptif_'.$i]) ? $_POST['descriptif_'.$i] : '';
            echo '<label>Jour '.$i.' : <textarea rows="10" cols="50" name="descriptif_'.$i.'">'.$descriptif.'</textarea></label><br/>';
            }
        echo '<input type="hidden" name="id_pays" value="'.$id_pays.'">';
            echo '<input type="hidden" name="nb_jours" value="'.$nb_jours.'">';
            echo '<button type="submit">Enregistrer</button>';
            echo '</form>';
        } else {
        echo '<p>Mauvais paramètre</p>';
                           }?>
    </div>
          <?php
        include('footer.html'); 
        ?>
  </body>
</html>