<section class='pageAdmin'>

	<?php

	if(isset($_SESSION["username"])){
		echo "<h2 id='bonjour'>Bonjour " . $_SESSION["username"] .", vous êtes connecté.</h2>";
		
		
		// echo "<p>";
		// echo $p = getPoints($_SESSION['id']);
		// echo "<br>";
		// echo $p = ajoutePoints($_SESSION['id'],100);
		// echo "<br>";
		// echo $p = getPoints($_SESSION['id']);
		// echo "</p>";

		if(count($_POST) != 0){
			if($_POST['action'] == 'ajouter'){
				creer_admin();
			}
			elseif($_POST['action'] == 'supprimer'){
				supprimer_utilisateur();
			}

		}


		if($_SESSION["is_admin"] == 1){
			echo '<div id="admin" class="container-fluid tm-container-content tm-mt-60">
			<article>';
			afficher_admin();
			echo '<h3>Ajout d\'un administrateur</h3>
			<form action="index.php?page=admin" method="post">
			<div class="form">
				<label for="username">Pseudo </label>
				<input type="string" name="pseudo">
			</div>
			<div class="form">
				<label for="password">Mot de passe </label>
				<input type="int" name="mdp">
			</div>
				<input type="submit" name="action" value="ajouter">
			</div>
			</form>
			</article>';
			
			echo '<article>
			<h3>Suppression d\'un utilisateur</h3>
			<form method="post" action="index.php?page=admin">

				<p><label>Pseudo de l\'utilisateur à supprimer</label><input type="text" name="username" placeholder="Nom"></p><br>
				<p><input type="submit" name="action" value="supprimer">
			</form>
			</article>
			</div>';
		}
	}
?>

</section>
