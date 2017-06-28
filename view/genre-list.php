<select name="genre">
<?php
    include('model/dao/GenreDAO.php');
    $genres = GenreDAO::findAll();
    foreach ($genres as $genre) {
        echo '<option value="'.$genre['id'].'">'.$genre['nom'].'</option>';
    }
    
?>
</select>




