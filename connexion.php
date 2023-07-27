<?php
  session_start();
  include("connex.inc.php");
  $pdo= connexion('ml05668t');
  if(isset($_POST['envoi'])){
      if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $mdp = md5($_POST['mdp']);
          $recup_membre =$pdo->prepare('SELECT * FROM membre WHERE pseudo= ? && mdp= ?');
          $recup_membre->execute(array($pseudo,$mdp));
          if($recup_membre->rowCount() > 0){
              $membre = $recup_membre->fetch();
              $statut = $membre['statut'];
              $id =$membre['id'];
              $_SESSION['pseudo']= $pseudo;
              $_SESSION['mdp']= $mdp;
              $_SESSION['statut']=$statut;
              $_SESSION['id']=$id;
              echo "id du membre : " .$id;    
              echo $_SESSION['statut'];
              echo "correcte";
               header("Location: index.php");
          }    
          else{
              echo "Mot de passe ou pseudo incorrecte";
          }    	   
		
      }
      else{
          echo "nn";
      }	  	
  }   	  
  	  
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <?php include("header.php") ?> 
      <form method="POST" action="#">
        <div class="form_connexion">
      <div class="test">
          <h2>Connexion</h2> 
          <input type="text" name="pseudo" placeholder="pseudo" required="required" >
          <br>
          <input type="password" name="mdp" placeholder="Mot de passe" required="required" >
          <br><br>
          <input type="submit" name="envoi" value="connexion">
          <br>
      <input type="button" name="inscription" value="inscription" onclick="window.location.href='inscription.php'">
         
        </div>
      </form>
  </body>
</html>
