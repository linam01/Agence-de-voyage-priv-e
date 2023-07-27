<header>
    <div class="logo">
        <a href="index.php"> <span>SL</span> Travel</a>
    </div>
    <ul class="menu">
        <li><a href="index.php">Acceuil</a></li>
        <li><a href="index.php#popular-destination">destinations</a></li>
        <?php if(isset($_SESSION['pseudo'])): ?>
            <?php if($_SESSION['statut'] == 1): ?>
                <li><a href="espace-admin.php">Mon compte</a></li>
            <?php else: ?>
                <li><a href="espace-membre.php">Mon compte</a></li>
            <?php endif; ?>
            <li><a href="deconnexion.php">Deconnexion</a></li>
        <?php else: ?>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
        <?php endif; ?>
    </ul>
    <div class="responsive-menu"></div>
</header>
        <script>
      var toggle_menu = document.querySelector('.responsive-menu');
      var menu = document.querySelector('.menu');
      toggle_menu.onclick= function(){
          toggle_menu.classList.toggle('active');
          menu.classList.toggle('responsive')
      }
    </script>   
