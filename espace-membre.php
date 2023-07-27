<?php
  session_start();
  if(!$_SESSION['mdp']){
      header('Location: connexion.php');
  }
  ?>

<!DOCTYPE html>

<html>
    <head>
      <title>Espace membre</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="menu-admin.css">
    </head>
    <body>
        <?php
        include("header.php");
        include("menu-membre.php");
        include("footer.html");
        ?>
    </body>
</html>
