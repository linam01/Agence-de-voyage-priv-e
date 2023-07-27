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
      <link  rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include("header.php")?>
        <?php include("menu-admin.php")?>
          <?php include("footer.html") ?> 
  </body>
</html>
