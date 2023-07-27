<?php
session_start();
include('connex.inc.php');
$pdo=connexion('ml05668t');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    try {
        $stmt = $pdo->prepare('INSERT INTO commentaire(pseudo, message, nom_pays) VALUES (:pseudo, :message, :nom_pays)');
        $stmt->bindParam(':pseudo', $_POST['pseudo']);
        $stmt->bindParam(':message', $_POST['message']);
        $stmt->bindParam(':nom_pays', $_POST['pays']);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo = null;
        header("Location: voyage.php?nom={$_POST['pays']}");
    }catch (PDOException $e) {
        echo 'Erreur PDO';
        echo $e->getMessage();
    }
} else {
    echo "<p>Mauvais paramètre</p>";
}
?>