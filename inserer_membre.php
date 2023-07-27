<?php
  session_start();
  if(!$_SESSION['mdp'] && $_SESSION['statut'!=1] ){
     header('Location: connexion.php');
  }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Insertion</title>
        <link rel="stylesheet" href="style.css">
         <link rel="stylesheet" href="inserer_voyage.css">
    </head>
  <body>
      
      <?php
      include('header.php');
      include('menu-admin.php');
      ?>
      <h1>Ajouter un membres</h1>
      <form action="ajouter_membre.php" method="post" class="form_voyage" >
          <label>Pseudo : </label><input type="text" name="pseudo" placeholder="pseudo" required="required"><br>
          <label>Mot de passe :</label> <input type="password" name="mdp" placeholder="password" required="required"><br>
          <label>Statut : </label>
              <select name="statut" required="required">
                  <option value="0">Membre</option>          
                  <option value="1">Administrateur</option>          
              </select>
         <br>
          <button type="submit" class="button_ajouter">Ajouter</button>
      </form>
      <?php
      include('footer.html');
      ?>
  </body>
</html>