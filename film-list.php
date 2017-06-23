<?php

include('model/dao/FilmDAO.php');

$recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_STRING);
if ($recherche){

   $films =  FilmDAO::findByTitle($recherche);

}else{
   $films = FilmDAO::findAll();

}
    

     //on va chercher la liste des films 'bookmarqué'
     $vus = [];
     if (isset($_SESSION['user_id'])){
        $vus = FilmDAO::findByBookMarked($_SESSION['user_id']);
        
     }
     
    

    ?>

    <h2>Liste des films</h2>
    <a href="index.php?page=film-form">ajouter un film</a>
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
        echo '<li film-id="'.$film['id'].'"><div><img src="'.$film['thumbnail'].'"/><h3>'.$film['titre'].'</h3><p class="auteur">réalisé par:'.$film['auteur'].'</p>';
        if (in_array($film['id'], $vus)){
            echo '<a class="bookmark seen" href="javascript:void();"></a>';
        }else{
            echo '<a class="bookmark" href="javascript:void();"></a>';
        }
              
        echo '</div></li>';
        
       //var_dump($donnees);
    }
    echo '</ul>';
    
    ?>

    <style>

        
        .film-list a.bookmark:before {
            content: "\2606";
        }
        .film-list a.seen:before {
          content: "\2605";
        }
        
    </style>
    <script>
        
        function toggleSeen(e){
            var that = this;
            var filmId = this.parentNode.parentNode.getAttribute('film-id'); 
            var req = new XMLHttpRequest();
            var data = new FormData();
            data.append('film_id',filmId );
            data.append('seen',!this.classList.contains('seen') );
            req.open('POST', 'film-seen.php', true);
            req.onload = function () {
              if(this.status === 200){ //response ok
                 that.classList.toggle('seen');
              }else if (this.status==403){
                  alert('vous devez être connecté pour pouvoir effectuer cette action ');
                  
              }else{
                  alert(this.responseText);
              }
                
            };
            req.send(data);
            
            
            
        }
        
        var $as = document.querySelectorAll('.film-list a.bookmark');
        for (var i = 0; i < $as.length; i++) {
            $as[i].onclick = toggleSeen;
        }
        
    </script>