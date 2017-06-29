<h3>Connexion membre:</h3>
<form action="/login" method="post">
    <p>
    <label for="titre">login :</label>
    <input type="text" name="login" placeholder="login" required/>*
    </p>
    <p>
    <label for="titre">mot de passe :</label>
    <input type="password" name="mdp" placeholder="mot de passe" required/>
    <input  type="submit" name="ok" value="ok"/>
    </p>
</form>
<p class="alert">{{error}}</p>





