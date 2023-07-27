<?php
if (isset($_POST['id_pays']) && isset($_POST['nb_jours'])) {
    $id_pays = $_POST['id_pays'];
    $nb_jours = intval($_POST['nb_jours']);

    // Connexion à la base de données
    include('connex.inc.php');
    $pdo = connexion('ml05668t');

    try {
        // Insérer les descriptions des jours dans la base de données
        for ($i = 1; $i <= $nb_jours; $i++) {
            $description = $_POST['descriptif_'.$i];
            $stmt = $pdo->prepare('INSERT INTO jour (id_pays, numero_jour, description) VALUES (:id_pays, :numero_jour, :description)');
            $stmt->bindParam(':id_pays', $id_pays);
            $stmt->bindParam(':numero_jour', $i);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            $stmt->closeCursor();
        }

        // Rediriger vers la page de liste des voyages
        header('Location: liste_voyage.php');
    } catch (PDOException $e) {
        echo 'Erreur PDO';
        echo $e->getMessage();
    }

    $pdo = null;
} else {
    echo '<p>Mauvais paramètre</p>';
}
?>