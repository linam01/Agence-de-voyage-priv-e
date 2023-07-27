<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Espace Administrateur</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include("header.php");
        if($_SESSION['statut']==0){
            include("menu-membre.php");
        }else{
            include("menu-admin.php");
            }
        ?> 
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Vérifier que les champs ne sont pas vides
            if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
                
                // Récupérer les valeurs des champs
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                $user_id = $_SESSION['id'];
               // var_dump($_SESSION);
                
                // Vérifier que le nouveau mot de passe et la confirmation correspondent
                if ($new_password == $confirm_password) {
                  
                    // Vérifier que le mot de passe actuel est correct pour cet utilisateur
                    include("connex.inc.php");
                    $pdo = connexion('ml05668t');
                    $stmt = $pdo->prepare('SELECT id FROM membre WHERE id = :id AND mdp = :mdp');
                    $stmt->execute(array(':id' => $user_id, ':mdp' => $current_password));
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($result) {
                        // Mettre à jour le mot de passe de l'utilisateur
                        $stmt = $pdo->prepare('UPDATE membre SET mdp = :mdp WHERE id = :id');
                        $stmt->execute(array(':mdp' => $new_password, ':id' => $user_id));
                        $_SESSION['mdp'] = $new_password;
                        echo "<p class='text'>Le mot de passe à bien été mordifier</p>";
                        
                    } else {
                        $error_message = 'Le mot de passe actuel est incorrect.';
                    }
                    
                } else {
                    $error_message = 'Le nouveau mot de passe et la confirmation ne correspondent pas.';
                }
        
            } else {
            $error_message = 'Veuillez remplir tous les champs.';
        }
        }
        include("footer.html"); 
        
        ?>
    </body>
</html>


