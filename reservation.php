<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
       <link rel="stylesheet" href="style.css">
         <link rel="stylesheet" href="enregistrer.css">
         <link rel="stylesheet" href="menu-admin.css">
     <style>
      h1,h2 {
  text-align: center;
          margin-bottom:20px;
      }
      input{
          color:black;
      }
     
     </style>
        </head>
        <body>
            <?php
            include("header.php"); 
            ?>
             <div class="enregistrer"> 
            <h1>Réservation</h1>
        
            <?php if (!isset($_POST['nb_personnes'])) { ?>
                <form action="reservation.php?id_pays=<?php echo isset($_GET['id_pays']) ? $_GET['id_pays'] : '';?>" method="post">
                    <label for="nb_personnes">Nombre de personnes :</label>
                    <input style type="number" name="nb_personnes" id="nb_personnes" required>
                    <button type="submit">Valider</button>
                </form>
            <?php } else { ?>
                <form action="traitement_reservation.php?id_pays=<?php echo isset($_GET['id_pays']) ? $_GET['id_pays'] : '';?>" method="post">
                    <?php for ($i = 1; $i <= $_POST['nb_personnes']; $i++) { ?>
                        <label for="nom_<?php echo $i ?>">Nom de la personne <?php echo $i ?> :</label>
                        <input type="text" name="nom_<?php echo $i ?>" id="nom_<?php echo $i ?>" required>
                        
                        <label for="prenom_<?php echo $i ?>">Prénom de la personne <?php echo $i ?> :</label>
                    <input type="text" name="prenom_<?php echo $i ?>" id="prenom_<?php echo $i ?>" required>
                    
                    <br/>
                    <br/>
                    <?php } ?>
                    <input type="hidden" name="nb_personnes" value="<?php echo isset($_POST['nb_personnes']) ? $_POST['nb_personnes'] : ''; ?>">
                    <button  type="submit">Valider</button>
                </form>
            <?php }
            ?>
</div> 
            <?php
            include("footer.html"); 
            ?>
            
        </body>
</html>