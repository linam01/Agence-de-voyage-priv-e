<?php
session_start();
if(!$_SESSION['mdp'] ){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Parametre</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="inserer_voyage.css">                   
    </head>
    <body>
        <?php
        include("header.php");
        if($_SESSION['statut']==1){
            include("menu-admin.php");
        }else{
            include("menu-membre.php");
        }
        ?>
        
        <!-- formualire pour chnager de mot de passe -->
        <div class="param-form" id="param-form">
            <h1>Paramètres</h1>
            <div class="parameters">
                <p>Vous pouvez modifier vos paramètres ici.</p>
                <form method="POST" action="changepassword.php" class="form_voyage">
                    <label for="current-password">Mot de passe actuel :</label>
                    <input type="password" id="current-password" name="current_password" required>
                    <label for="new-password">Nouveau mot de passe :</label>
                    <input type="password" id="new-password" name="new_password" required>
                    <label for="confirm-password">Confirmer le nouveau mot de passe :</label>
                    <input type="password" id="confirm-password" name="confirm_password" required>
                    <button class="button_ajouter">Modifier le mot de passe</button>
                     <!-- supperimer son compte -->
                <?php 
                echo '<a href="supprimer_compte.php?id=' . $_SESSION["id"] . '">Supprimer  mon compte </a>';              
                ?> 
                </form>
                                             
            </div>
            <?php include("footer.html") ?> 
        </div>
    </body>
</html>