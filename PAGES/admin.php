<section id='pageAdmin'>
	<?php
	if(isset($_SESSION["username"])){
		echo "<h2 id='bonjour'>Bonjour " . $_SESSION["username"] .", vous êtes connecté en admin.</h2>";
		if(count($_POST) != 0){
			if($_POST['action'] == 'ajouter'){
				ajouter_admin();
			}
			elseif($_POST['action'] == 'supprimer'){
				delete_admin();
			}
		}
		afficher_admin();
		if($_SESSION["is_admin"] == 1){
			echo '<section id="admin">
			<article>
			<h3>Ajout d\'un administrateur</h3>
			<form action="index.php?page=admin" method="post">
			<div class="form">
				<label for="username">Pseudo </label>
				<input type="string" name="username">
			</div>
			<div class="form">
				<label for="password">Mot de passe </label>
				<input type="int" name="password">
			</div>
				<input type="submit" name="action" value="ajouter">
			</div>
			</form>
			</article>';
			
			echo '<article>
			<h3>Suppression d\'un administrateur</h3>
			<form method="post" action="index.php?page=admin">

				<p><label>Pseudo de l\'administrateur à supprimer</label><input type="text" name="username" placeholder="Nom"></p><br>
				<p><input type="submit" name="action" value="supprimer">
			</form>
			</article>
			</section>';
		}
	}
?>
	
<a id= "deco" href='index.php?deconnexion=1'>Déconnexion</a>
</section>
