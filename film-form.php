<style>
    #film-form label{
        display: block;
        width: 150px;
        float: left;
    }
    
</style>
        <form id="film-form" action="index.php?page=film-form-handler" method="post">
            <fieldset>
                <legend>Nouveau film</legend>
                <p>
                <label for="titre">titre :</label>
                <input type="text" name="titre" placeholder="titre du film" required/>
                </p>
                <p>
                <label for="titre">auteur :</label>
                <input type="text" name="auteur" placeholder="auteur" required/>
                </p>
                <p>
                <label for="titre">acteurs :</label>
                <input type="text" name="acteurs" placeholder="acteurs required"/>
                </p>
                <p>
                <label for="titre">année de sortie :</label>
                <input  name="date_sortie" placeholder="date de sortie" required/>
                </p>
                <p>
                <label for="genre">genre :</label>
                <?php include('view/genre-list.php'); ?>
                </p>
                <p>
                <input  type="submit" name="ok" value="ok"/>
                <input  type="reset" name="reset" value="effacer"/>
                </p>
            </fieldset>
        </form>
        
        <script>
            //exemple de control sur un formulaire en js
            $btnSubmit = document.forms["film-form"]['ok'];
            $btnSubmit.onclick = function(e){
                var valid = true;
                
                
                
                //test sur la date
                var dt_now=new Date();
                
                var annee_sortie = parseInt(document.forms["film-form"]['date_sortie'].value);
                if (isNaN(annee_sortie) || annee_sortie < 1935 || annee_sortie > dt_now.getFullYear()){
                    valid = false;
                    alert('oulala ça marche pas du tout pour la date...');
                }
                
                
                if (!valid){
                    //on empêche le submit du formulaire
                    e.preventDefault();
                }
            }
            
        </script>


