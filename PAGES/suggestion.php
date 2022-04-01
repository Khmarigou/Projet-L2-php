<section class="recherche">
	<script type = "text/javascript" src="./JS/recherche.js"></script> 	
	<form action="./?page=resultats" method="POST" autocomplete="off">
			<?php
			$sql = "SELECT titre FROM dvd";
			$listeTitres = recup_dvd_sql ($sql);
			foreach ($listeTitres as $key => $value) {
				$Titres[] = $value['titre'];
			}
			?>
		<div class="autocomplete" >
			<input id='Titre' type='text' placeholder='Titre' name='Titre'>
		</div>
        	<input type="submit" name='recherche'  value='Rechercher'>
		<script type="text/javascript">
			var passedArray = <?php echo json_encode($Titres); ?>;
			autocomplete(document.getElementById("Titre"), passedArray);
		</script>
    </form>
</section>

<section class="suggestion">
	<?php 
		afficher_dvd($dvd);
	?>
</section>