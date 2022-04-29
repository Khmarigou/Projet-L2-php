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
			if($_POST['action'] == 'Ajouter'){
				creer_admin();
			}
			elseif($_POST['action'] == 'Supprimer'){
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
				<p><select name="username" id="username">

	        	<option value="">--Selectionner L\'utilisateur--</option>';
	            $sql = "SELECT * FROM `User` WHERE is_admin = 0";
	            $listeUser = recup_dvd_sql($sql);
	            foreach ($listeUser as $key => $value) {
	                echo "<option value='".$value["username"]."'> ".$value["username"]." </option>";
	            }
				echo '</p>
				</select></br>
				<p><input type="submit" name="action" value="Ajouter"></p>
			</div>
			</form>
			</article>';
			
			echo '<article>
			<h3>Suppression d\'un utilisateur</h3>
			<form method="post" action="index.php?page=admin">
				<p><select name="Username" id="Username">
        		<option value="">--Selectionner L\'utilisateur--</option>';
            $sql = "SELECT * FROM `User` WHERE is_admin = 1";
            $listeAdmin = recup_dvd_sql($sql);
            foreach ($listeAdmin as $key => $value) {
                echo "<option value='".$value["username"]."'> ".$value["username"]." </option>";
            }
			echo '</p>
			</select></br>
			<p><input type="submit" name="action" value="Supprimer"></p>
			</form>
			</article>
			</div>';
		}
	}
?>

</section>
