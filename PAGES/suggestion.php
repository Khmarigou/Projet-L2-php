<section class="recherche">
	<script type = "text/javascript" src="./JS/recherche.js"></script> 	
	<form action="./?page=resultats" method="POST">
	    <input id="barreDeRecherche" onkeyup="search()" type="text" name="recherche" placeholder="Titre">
	    <input type="submit" name='recherche'  value='Rechercher'>
    </form>
</section>

<section class="suggestion">
	<?php 
	afficher_dvd($dvd);
	?>
</section>