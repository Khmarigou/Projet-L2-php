<?php

function posterAnnonce(){
?>
<article>


	<h2>Louer votre DVD</h2>
	<form method="post" action="louerModel.php">

		<fieldset>
			<legend>Contact</legend>
				<p><label>Titre du film</label> <input type="text" name="titre"></p><br>

                <p><label>Catégorie</label>
					<select name="licence">
						<option value="">--Choisir une option--</option>
						<option value="0">Adhésion Adulte Mouxy</option>
		    			<option value="1">Adhésion Adulte Exterieur</option>
		    			<option value="2">Adhésion Etudiant</option>
		    			<option value="3">Adhésion Jeune</option>
                    </select></p><br>

				<p><label>Résumé</label> <input type="text" name="resume"></p><br>

                <! label pour mettre une image >
	
				<p><label>Durée location</label> <input type="date" name="location"></p><br>

                

				<p><label>Sexe</label>
					<select name="genre">
						<option value="">--Choisir une option--</option>
						<option value="0">Femme</option>
		    			<option value="1">Homme</option>
					</select></p><br>

				<p><label>Main</label>
					<select name="main">
						<option value="">--Choisir une option--</option>
						<option value="0">Droitier</option>
		    			<option value="1">Gaucher</option>
					</select></p><br>
		


		
			<legend>Informations tennistiques</legend>

				
					

				<p><label>Classement</label> <input type="text" name="rank"></p><br>

				<p><label>Revers</label>
					<select name="revers">
						<option value="">--Choisir une option--</option>
						<option value="0">Deux mains</option>
		    			<option value="1">Une main</option>
					</select></p><br>
		</fieldset>
			
		<p><input type="submit" name="action" value="Ajouter">
	</form>


</article>
<?php
}

?>