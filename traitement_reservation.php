
<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

include("connex.inc.php");
$pdo=connexion('ml05668t');
$id= $_SESSION['id'];
$id_pays=$_GET['id_pays'];
$nb_voyageur = intval($_POST['nb_personnes']);
$date = date('Y-m-d');
// Récupérer le prix du pays correspondant à l'id
$sql = "SELECT prix FROM pays WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id_pays]);
$row = $stmt->fetch();

// Calculer le prix en fonction du nombre de voyageurs
$prix = $row['prix'] * $nb_voyageur;

// Préparer la requête pour insérer la réservation
try {
$stmt_reservation = $pdo->prepare('INSERT INTO reservation (id_membre, id_pays, nb_voyageur, date, prix) VALUES (:id_membre, :id_pays, :nb_voyageur, :date ,:prix)');
$stmt_reservation->bindParam(':id_membre', $id);
$stmt_reservation->bindParam(':id_pays',$id_pays );
$stmt_reservation->bindParam(':nb_voyageur',$nb_voyageur);
$stmt_reservation->bindParam(':date',$date);
$stmt_reservation->bindParam(':prix',$prix);
$stmt_reservation->execute();

// Récupérer l'ID de la réservation qui vient d'être créée
$id_reservation = $pdo->lastInsertId();
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
// Préparer la requête pour insérer les voyageurs
$stmt_voyageur = $pdo->prepare('INSERT INTO voyageur (nom, prenom, id_reservation) VALUES (:nom, :prenom, :id_reservation)');

try {
    // Boucler sur le nombre de voyageurs saisis dans le formulaire
    for ($i = 1; $i <= $_POST['nb_personnes']; $i++) {
        // Vérifier si les champs pour ce voyageur ont été remplis
        if (isset($_POST['nom_'.$i]) && isset($_POST['prenom_'.$i])) {
            // Insérer le voyageur dans la base de données
            $nom = $_POST['nom_'.$i];
            $prenom = $_POST['prenom_' . $i];
            $stmt_voyageur->bindParam(':nom', $nom);
            $stmt_voyageur->bindParam(':prenom', $prenom);
            $stmt_voyageur->bindParam(':id_reservation', $id_reservation);
            $stmt_voyageur->execute();
            $stmt_voyageur->closeCursor();
        }
    }
} catch(PDOException $e) {
    echo '<p>Problème PDO</p>';
    echo $e->getMessage();
}

//header('Location: paiement_reservation.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
    <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="enregistrer.css">
           <link rel="stylesheet" href="liste_membres.css">
               <link rel="stylesheet" href="voyage.css">  


    </head>
    <body>
        <?php include("header.php"); ?>
             <div class="enregistrer">                                    

        <p> reservation validé pour un montant de <?php echo $prix?> € pour <?php echo $nb_voyageur?> voyageur(s)</p>
        <ul>
            <?php
            $stmt = $pdo->prepare('SELECT nom, prenom FROM voyageur WHERE id_reservation = :id_reservation');
            $stmt->execute(['id_reservation' => $id_reservation]);
    
            // Itérer sur chaque voyageur et afficher son nom et prénom
            while ($row = $stmt->fetch()) {
                echo '<li>' . $row['nom'] . ' ' . $row['prenom'] . '</li>';
            }
            
            $stmt->closeCursor();
            ?>
        </ul>
        <a href="espace-membre.php#reserv">Voir mes reservation</a>
        </div>
                        <?php include("footer.html"); ?>
                
    </body>
</html>

                                             

