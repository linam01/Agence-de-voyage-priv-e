<?php
session_start();
if(!$_SESSION['mdp']){
      header('Location: connexion.php');
  }
echo  $_SESSION['pseudo'];
?>
<!Doctype html>
<html lang="fr">
          <head>
    <meta charset="utf-8">
                 <title>Acceuil</title>
        <link rel="stylesheet" href="style.css">
                               </head>
  <body>
      a
<?php include("header.php") ?>

   <section id="contact">
   <h1 class="title">Contact</h1>
      <form action="traitement-formulaire-contact.php"  method="post">
        <div class="left-right">
          <div class="left">
            <label>Nom Complet</label>
            <input type="text"  id="nom" name="nom_complet"  required="required">
            <label>Objet</label>
            <input type="text" id="objet" name="objet" required="required">
            <label>Email</label>
            <input type="email" id="email" name="email" required="required">
            <label>Message</label>
            <textarea  name="message" cols="30" rows="10" id="message"  required="required"></textarea>
          </div>
          <div class="right">
            <label>Numéro</label>
            <input type="text" name="numero"  id="num_tel" maxlength="10"  minlength="10" required="required" >
            <label>Date</label>
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
             <label>Autres Details</label>
            <input type="text" name="autre_details"   required="required" >
            <label>Adresse</label>
            <textarea cols="30" rows="10" id="adresse"required="required" ></textarea>
          </div>
        </div>
        <button onclick="verifierFormulaire()">Envoyer</button>
      </form>
      <p class="phrase" id="tel" >Le numero entrée n&apos;est pas valide. Veuillez réessayer.</p>
      <p class="phrase" id="id_mail" >L&apos;email entrée n&apos;est pas valide. Veuillez réessayer.</p>
<p class="phrase" id="p_nom" >Le nom entrée n&apos;est pas valide. Veuillez réessayer.</p>
      <p class="phrase" id="p_objet" >L&apos;objet entrée n&apos;est pas valide. Veuillez réessayer.</p>
      <p class="phrase" id="p_message" >Le message entrée n&apos;est pas valide. Veuillez réessayer.</p>
      <p class="phrase" id="p_date" >La date entrée n&apos;est pas valide. Veuillez réessayer.</p>
    </section>
<?php include('footer.html');
    ?>
 <script src="contact.js"></script>
    </body>
</html>