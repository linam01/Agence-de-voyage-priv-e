 <?php
  session_start();
  if(!$_SESSION['mdp'] && $_SESSION['statut'] != 1){
    header('Location: connexion.php');
  }
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Insertion Voyage</title>
   <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="inserer_voyage.css">
</head>
<body>
 
 <?php
  include('header.php');
  include('menu-admin.php');
  ?>

  <h1>Ajouter un voyage</h1>

  <form action="ajouter_voyage.php" method="post" class="form_voyage">
    <label>Nom :</label>
    <input type="text" name="nom" placeholder="Nom" required="required"><br>

    <label>Prix :</label>
    <input type="text" name="prix" placeholder="Prix" required="required"><br>

    <label>Date début :</label>
    <input type="date" name="date_debut" required="required"><br>

    <label>Date fin :</label>
    <input type="date" name="date_fin" required="required"><br>
    <label>Image :</label><input type="text" name="image"><br>
     <label>Présentation :</label>
    <textarea name="presentation" required="required" placeholder="Entrez votre message ici" rows="4" cols="40" ></textarea><br>
    <button type="submit" class="button_ajouter">Ajouter</button>
  </form>

  <?php
  include('footer.html');
  ?>
</body>
</html>
