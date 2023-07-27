<?php
if (isset($_POST['pseudo']) && isset($_POST['tri']) && isset($_POST['ordre'])){   
    if ($_POST['tri'] === 'pseudo') {
        $tri = 'pseudo';
    }
    $ordre = 'ASC';
    if ($_POST['ordre'] === 'DESC') {
        $ordre = 'DESC';
    }    
    $req = $pdo->prepare("SELECT * FROM membre WHERE pseudo LIKE :pseudo  ORDER BY $tri $ordre");
    $pseudo = '%'.$_POST['pseudo'].'%';  
    $req->bindParam(':pseudo', $pseudo);
    $req->execute();
    $membres = $req->fetchAll(PDO::FETCH_ASSOC);
    echo '<p>'.count($membres).'membres  correspondent à votre requête :</p>';
    echo '<ul>';
    foreach($membres as $membre) {
        // echo "<li>${etudiant['nom']} ${etudiant['age']} ${etudiant['filiere']}</li>";
        echo '<li>'.$membre['pseudo'].  '<a href="supprimer_membre.php?id='.$membre['id'].'">supprimer</a> <a href="modifier_membre.php?id='.$membre['id'].'">modifier</a></li>';
    }
    echo '</ul>';
    $req->closeCursor();
    
}
else {
    echo '<p>Critères de recherche non spécifiés';
}
?>