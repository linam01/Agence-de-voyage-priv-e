
<?php
session_start();
if(!$_SESSION['mdp']){
header('Location: connexion.php');
}
 ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">  
	<title>Page de voyage</title>     
         <link rel="stylesheet" href="style.css">
         <link rel="stylesheet" href="liste_membres.css">
         <link rel="stylesheet" href="enregistrer.css">
         <link rel="stylesheet" href="menu-admin.css">
         <style>
         h1,h2 {
  text-align: center;
  margin-bottom:20px;
}
</style>
</head>
<body>

<?php
include('header.php');
include('connex.inc.php');
$pdo = connexion('ml05668t');

// Récupérer l'identifiant du pays dans l'URL
$id_pays = $_GET['id_voyage'];

// Requête pour récupérer les informations du pays
$sql_pays = "SELECT * FROM pays WHERE id=:id";
$stmt_pays = $pdo->prepare($sql_pays);
$stmt_pays->execute(['id' => $id_pays]);
$pays = $stmt_pays->fetch();

// Requête pour récupérer la liste des jours de voyage
$sql_jours = "SELECT * FROM jour WHERE id_pays=:id_pays";
$stmt_jours = $pdo->prepare($sql_jours);
$stmt_jours->execute(['id_pays' => $id_pays]);
$jours = $stmt_jours->fetchAll();

echo "<h1>" . $pays['nom'] . "</h1>";
echo "<p>" . $pays['presentation'] . "</p>";
echo "<p>Prix : " . $pays['prix'] . "  </p>";
echo "<p>Date de départ : " . $pays['date_debut'] . "</p>";
echo "<p>Date de retour : " . $pays['date_fin'] . "</p>";

echo "<h2>Description du voyage</h2>";

echo "<table>";
echo "<tr><th>Jour</th><th>Description</th></tr>";

foreach ($jours as $jour) {
    echo "<tr>";
    echo "<td class='center'>" . $jour['numero_jour'] . "</td>";
    echo "<td class='center'>" . $jour['description'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<div class='liste'";
echo "<li><a  href='reservation.php?id_pays=" . $pays['id'] . "'>Réserver</a></li>";
echo "</div>";
$pdo = null;
include('footer.html');
?>
   
   

</body>
</html>
