<?php
include("connex.inc.php");
$pdo = connexion('ml05668t');
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])){
          $pseudo=htmlspecialchars($_POST['pseudo']);
          $mdp=md5($_POST['mdp']);
          $nom=htmlspecialchars($_POST['nom']);
          $prenom=htmlspecialchars($_POST['prenom']);
          $email=htmlspecialchars($_POST['email']);
         // Vérification du pseudo
          $verif_pseudo = $pdo->prepare('SELECT COUNT(*) FROM membre WHERE pseudo = ?');
          $verif_pseudo->execute(array($pseudo));
          $pseudo_deja_pris = ($verif_pseudo->fetchColumn() > 0);

          // Vérification de l'email
          $verif_email = $pdo->prepare('SELECT COUNT(*) FROM membre WHERE email = ?');
          $verif_email->execute(array($email));
        $email_deja_pris = ($verif_email->fetchColumn() > 0);
        
             // Si le pseudo ou l'email est déjà associé à un autre compte, afficher un message d'erreur
        if($pseudo_deja_pris && $email_deja_pris){
            echo "Le pseudo et l'adresse email sont déjà associés à un compte.";
        } else if ($pseudo_deja_pris) {
            echo "Le pseudo est déjà associé à un compte.";
        } else if ($email_deja_pris) {
            echo "L'adresse email est déjà associée à un compte.";
        }
    } else {
        $insert_membre = $pdo->prepare('INSERT INTO membre(pseudo,mdp,nom,prenom,email) VALUES(?, ?, ?, ?, ?)');
        $insert_membre->execute(array($pseudo, $mdp, $nom, $prenom, $email));
        echo 'Inscription validée';
    }
} else {
    echo "Veuillez compléter le formulaire";
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="connexion.css">
<link rel="stylesheet" href="style.css">
  </head>
  <body>
    
<?php include("header.php") ?> 
     <form method="POST" action="#">
       <div class="form_connexion">
         <div class="test">
           <h2>Inscription</h2> 
           <input type="text" name="pseudo" placeholder="pseudo" required="required"maxlength="50" >
</br>
<input type="password" name="mdp" placeholder="Mot de passe" maxlength="50" required="required" >

<br>
    <input type="text" name="nom" placeholder="Nom" required>
<br/>
<input type="text" name="prenom" placeholder="Prénom" required>
<br/>
<input type="email" name="email" placeholder="Adresse e-mail" required>
<br/><br>
<input type="submit" name="envoi" value="inscription"></div>
       </div>
     </form>
  </body>
</html>