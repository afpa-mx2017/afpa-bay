<form  action="/register" method="post">
    <p>
    <label for="login">login :</label>
    <input type="text" name="login" placeholder="login" required/>
    </p>
    <p>
    <label for="email">email :</label>
    <input type="text" name="email" placeholder="email" required/>
    </p>
    <p>
    <label for="mdp">mot de passe :</label>
    <input type="password" name="mdp" placeholder="mot de passe" required/>
    </p>
    <p>
    <label for="mdp_verif">confirmation de mot de passe :</label>
    <input type="password" name="mdp_verif" placeholder="mot de passe" required/>
    <input  type="submit" name="ok" value="ok"/>
    </p>

</form>
<p class="alert">{{error}}</p>