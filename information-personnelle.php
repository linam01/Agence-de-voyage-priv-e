<?php
session_start();
if(!isset($_SESSION['mdp'])){
    header('Location: connexion.php');
}
include('connex.inc.php');
$pdo=connexion('ml05668t');
$id=$_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM membre WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$utilisateur = $stmt->fetch();
?>

<!Doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Information personelle</title>  
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="espace-membre.css">
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
        <div class="contact-form" onclick="">
            <h2>Vos informations</h2>
            <form class="form-membre" action="traitement-information-personnelle.php" method="post">
                <fieldset>
                    <legend><strong>Civilité</strong></legend>
                    <br />
                    <label for="pseudo">Pseudo</label><br>
                    <input type="text" id="pseudo" name="pseudo" value="<?php echo $_SESSION['pseudo']; ?>" readonly>
<br>
                    <label for="nom">Nom</label><br><input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>" required><br>
                    <label for="prenom">Prénom</label><br><input type="text" id="prenom" name="prenom"  value="<?php echo $utilisateur['prenom']; ?>" required>
                    <br />
                </fieldset>
                <fieldset>
                    <legend><strong>Contact</strong></legend>
                    <label for="adresse">Adresse</label><br><textarea id="adresse" rows="2" cols="50" name="adresse"><?php echo $utilisateur['adresse']?></textarea>
                    <br />
                    <label for="cp">Code postal</label><br><input type="text" id="cp" maxlength="5" value="<?php echo $utilisateur['cp']?>" name="cp"><br>
                    <label for="ville">Ville</label><br><input type="text" id="ville" name="ville" value="<?php echo $utilisateur['ville']?>" />
                    <br />
                    <label for="email">Adresse email</label><br><input type="email" id="email" name="email" value="<?php echo $utilisateur['email']?>" required>
                </fieldset>  
                <button type="submit" class="button_ajouter" >Envoyer</button>
            </form>
        </div>        
        <?php include("footer.html"); ?>
    </body>
</html>

