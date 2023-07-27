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
    <?php include("header.php") ?> 
    <div class="contenu">
        <video autoplay loop muted class="video" >
        <source src="v.mp4" type="video/mp4">
      </video>
      <div class="accueil">
        <h1>Afrique <span id="element" class="animation"></span></h1>
      </div>
    </div>
     <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>
      <script>
      var typed = new Typed('#element',{
          strings: ['Tanzanie','Egypte','Algerie','Namibie','Tunisie','Maroc', 'Senegal', 'Kenya','Mauritanie'],
          typedSpeed:50,
          backSpeed:50,
          loop:true
          
      });
      </script>
    <!-- acceuil section -->
a
          <?php include("recherche.php");?>
        
    <br><br>
    <section id="popular-destination">
      <h1 class="title">Pays à visiter</h1>
      <div class="content">
        <div class="box">
          <img src="images/ethiopie.jpg" alt="Ethiopie">
          <div class="content">
            <div>
              <h4>Ethiopie</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=ethiopie">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/tanzanie.jpeg" alt="tanzanie">
          <div class="content">
            <div>
              <h4>Tanzanie</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Ea iusto ipsa repudiandae amet conseq.</p>
                <a href="voyage.php?nom=Tanzanie">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/kenya.jpg" alt="kenya">
          <div class="content">
            <div>
              <h4>Kenya</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Kenya">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/namibie.jpeg" alt="Namibie">
          <div class="content">
            <div>
              <h4>Namibie</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Namibie">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/algerie.jpg" alt="algerie">
          <div class="content">
            <div>
              <h4>Algerie</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Algerie">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/maroc.jpg" alt="Maroc">
          <div class="content">
            <div>
              <h4>Maroc</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Maroc">Lire Plus</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="popular-destination">
      <h1 class="title">Iles à visiter</h1>
      <div class="content">
        <div class="box">
          <img src="images/zanzibar.jpeg" alt="zanzibar">
          <div class="content">
            <div>
              <h4>Zanzibar</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Zanzibar">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/maurice.jpg" alt="maurice">
          <div class="content">
            <div>
              <h4>L&#039île Maurice</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Ea iusto ipsa repudiandae amet conseq.</p>
                <a href="voyage.php?nom=Maurice">lire plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/comore.jpeg" alt="comore">
          <div class="content">
            <div>
              <h4>Comore</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Comores">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/capvert.jpg" alt="cap-vert">
          <div class="content">
            <div>
              <h4>Le Cap vert</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Cap-vert">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/seychelles.jpg" alt="Seychelles">
          <div class="content">
            <div>
              <h4>Les Seychelles</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Seychelles">Lire Plus</a>
            </div>
          </div>
        </div>
        <div class="box">
          <img src="images/reunion.jpg" alt="la reunion">
          <div class="content">
            <div>
              <h4>La Reunion</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p>Ea iusto ipsa repudiandae amet conseq.</p>
              <a href="voyage.php?nom=Reunion">Lire Plus</a>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php
    include("footer.html") ?> 
           <script src="index.js"></script>
  </body>   
</html>