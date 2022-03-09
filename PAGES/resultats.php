<!-- <section class="recherche">
	<form action="./?page=resultats" method="POST">
		<input type="text" placeholder="Titre" name="Titre">
        <input type="submit" name='recherche'  value='Rechercher'>
    </form>
</section> -->

<section class="resultats">
	<?php
	$titre = $_POST['Titre'];
	$sql = "SELECT * FROM Dvdtest WHERE titre=$titre";
	$dvd = recup_dvd_sql ($sql);
	afficher_dvd($dvd);
	?>
</section>