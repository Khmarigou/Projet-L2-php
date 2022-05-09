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
			elseif($_POST['action'] == 'Enlever'){
				enlever_admin();
			}
		}


		if($_SESSION["is_admin"] == 1){
			//echo '<div id="admin" class="container-fluid tm-container-content tm-mt-60">';
			echo"</br><table id='table'><tr><td><h2>Liste des membres :</h2></td>";
			echo "<td><h2>Liste des administrateurs :</h2></td></tr>"; 
			echo'<tr><td>';
					afficher_membres();
					echo '</td><td>';
					afficher_admin();
					echo '</td></tr>';
					echo'<tr><td>';
					afficher_suppr_membres();
					echo '</td><td>';
					afficher_ajout_admin();
					echo '</td></tr>';
					echo '<tr><td></td><td>';
					afficher_suppr_admin();
					echo '</td></tr></table>';

			

			

			echo '</div>';
		}
	}
?>

</section>
