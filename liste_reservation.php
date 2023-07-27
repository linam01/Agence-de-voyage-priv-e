
   <?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit();
}

include('header.php');
if($_SESSION['statut']==1){
    include("menu-admin.php");
}else{
    include('menu-membre.php');
}
include('connex.inc.php');

$pdo = connexion('ml05668t');
$id_membre = $_SESSION['id'];

// Requête pour récupérer les réservations de l'utilisateur connecté
if($_SESSION['statut']==1){
$stmt = $pdo->prepare('SELECT r.*, p.nom AS nom_pays, p.date_debut FROM reservation r JOIN pays p ON r.id_pays = p.id');
}
else{
$stmt = $pdo->prepare('SELECT r.*, p.nom AS nom_pays, p.date_debut FROM reservation r JOIN pays p ON r.id_pays = p.id WHERE r.id_membre = :id_membre');

}
$stmt->bindParam(':id_membre', $id_membre);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tableaux pour les réservations à venir et passées
$reservationsAVenir = array();
$reservationsPassees = array();

// Séparation des réservations à venir et passées
foreach ($reservations as $reservation) {
    if ($reservation['date_debut'] > date('Y-m-d')) {
        $reservationsAVenir[] = $reservation;
    } else {
        $reservationsPassees[] = $reservation;
    }
}
?>

<!Doctype html>
<html>
    <head>
      <title>Reservation</title>
      <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="liste_membres.css">
    </head>
    <body>

<h1>Réservations à venir</h1>

<?php if (count($reservationsAVenir) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Date de réservation</th>
                <th>Pays</th>
                <th>Date de départ</th>
                <th>Nombre de voyageurs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservationsAVenir as $reservation): ?>
                <tr class='center'>
                    <td><?= $reservation['date'] ?></td>
                    <td><?= $reservation['nom_pays'] ?></td>
                    <td><?= $reservation['date_debut'] ?></td>
                    <td><?= $reservation['nb_voyageur'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucune réservation à venir.</p>
<?php endif; ?>

<h1>Réservations passées</h1>
<?php if (count($reservationsPassees) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Date de réservation</th>
                <th>Pays</th>
                <th>Date de départ</th>
                <th>Nombre de voyageurs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservationsPassees as $reservation): ?>
                <tr class='center'>
                    <td><?= $reservation['date'] ?></td>
                    <td><?= $reservation['nom_pays'] ?></td>
                    <td><?= $reservation['date_debut'] ?></td>
                    <td><?= $reservation['nb_voyageur'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                      <?php else: ?>
    <p>Aucune réservation passée.</p>
<?php endif; ?>
<?php include("footer.html") ?>
    </body>
</html>