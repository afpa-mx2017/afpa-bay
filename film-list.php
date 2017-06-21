<?php


$bdd = null;

try
{

    $bdd = new PDO('mysql:host=localhost;dbname=afpa-bay;charset=utf8', 'root', 'admin');

}catch (Exception $e)

{

        die('Erreur : ' . $e->getMessage());

}

    $recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_STRING);
    if ($recherche){
        
        $stmt = $bdd->prepare('SELECT * from film WHERE titre like :recherche');
        $stmt->bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
        $stmt->execute();

    }else{
        $stmt = $bdd->query('SELECT * from film');
       
    }
    
     $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    ?>

    <h2>Liste des films</h2>
    <a href="index.php?page=form-film">ajouter un film</a>
    <form method="get" action="index.php">
        <input type="text" name="recherche" value="<?php echo $recherche ?>"/>
        <input type="submit" name="ok" value="rechercher"/>
    </form>

    <?php
    echo '<em>'.count($films).' film(s) trouvé(s)</em>';
    
    echo '<ul class="film-list">';
    foreach ($films as $film) {
        if (!$film['thumbnail']){
            $film['thumbnail'] = "http://via.placeholder.com/300x400";
        }
        echo '<li><div><img src="'.$film['thumbnail'].'"/><h3>'.$film['titre'].'</h3><p class="auteur">réalisé par:'.$film['auteur'].'</p></div></li>';
       //var_dump($donnees);
    }
    echo '</ul>';
    
