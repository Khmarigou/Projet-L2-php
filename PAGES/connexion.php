<section class='connect'>
<?php
if(isset($_SESSION["username"])){
	header('Location: ./index.php?page=admin');
}
?>

    <section>
        <form action="../praujet/MVC/modele.php" method="POST">
                    <h2>Connexion</h2>
                    
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                    <br>
                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                    <br>
                    <input type="submit" name='login' >
        </form>

        <p>Vous n'avez pas de compte ? <a href=".?page=inscription">Inscrivez vous</a></p>

    </section>
</section>