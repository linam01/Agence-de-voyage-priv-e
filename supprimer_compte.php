<?php
session_start();
if(!isset($_SESSION['mdp'])){
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("connex.inc.php");
    $pdo = connexion('ml05668t');

    // Récupérer l'identifiant de l'utilisateur à partir de la session
    $id = $_SESSION['id'];
    echo ".$id";

    // Supprimer l'utilisateur de la base de données
     $stmt = $pdo->prepare('DELETE FROM membre WHERE id = :id');
     $stmt->execute(array(':id' => $id));

    // Rediriger l'utilisateur vers la page d'accueil
      header('Location: deconnexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer votre compte</title>
</head>
<body>
    <h1>Supprimer votre compte</h1>
    <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
    <form method="POST">
        <button type="submit">Confirmer la suppression du compte</button>
    </form>
</body>
</html>