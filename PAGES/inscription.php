<section class='connect'>

	<form action="../praujet/MODEL/modele.php" method="POST">
                <h2>inscription</h2>
                
                <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="name" required>

                <label><b>Nom</b></label>
                <input type="text" placeholder="Entrer votre nom" name="surname" required>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <label><b>Confirmer votre Mot de passe</b></label>
                <input type="password" placeholder="Confirmer votre mot de passe" name="confirmpassword" required>

                <input type="submit" name='register'>
    </form>
</section>