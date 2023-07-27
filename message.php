  <?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit();
}

include('connex.inc.php');

// Connexion à la base de données
$pdo = connexion('ml05668t');

// Requête pour récupérer les contacts
$stmt = $pdo->query('SELECT * FROM contact ORDER BY date DESC');
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Message</title>
      <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="liste_membres.css">
    </head>
    <body>
        <?php
        include("header.php");
        include("menu-admin.php");
        ?>
        <h1>Messages</h1>
        <table>
	    <thead>
		<tr>
		    <th>Nom</th>
		    <th>Objet</th>
		    <th>Email</th>
		    <th>Message</th>
		    <th>Date</th>
		</tr>
	    </thead>
	    <tbody>
		<?php foreach ($contacts as $contact): ?>
		    <tr class='center'>
			<td><?= $contact['nom_complet'] ?></td>
			<td><?= $contact['objet'] ?></td>
			<td><?= $contact['email'] ?></td>
			<td><?= $contact['message'] ?></td>
			<td><?= $contact['date'] ?></td>
				</tr>
		<?php endforeach; ?>
	    </tbody>
	</table>
        <?php include("footer.html"); ?>
    </body>
</html>