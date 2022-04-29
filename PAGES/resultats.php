<section class="recherche">
<script type = "text/javascript" src="./JS/recherche.js"></script> 	
	
	<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="../IMAGES/hero.jpg">
        <form class="d-flex tm-search-form" action="./?page=resultats" method="POST" autocomplete="off">
			<?php
				$sql = "SELECT titre FROM dvd";
				$listeTitres = recup_dvd_sql ($sql);
				foreach ($listeTitres as $key => $value) {
					$Titres[] = $value['titre'];
				}
			?>
            <input class="form-control tm-search-input" aria-label="Search" id='Titre' type='text' placeholder='Titre' name='Titre'>
            <button class="btn btn-outline-success tm-search-btn" type="submit" class="autocomplete">
                <i class="fas fa-search"></i>
            </button>
			<script type="text/javascript">
				var passedArray = <?php echo json_encode($Titres); ?>;
				autocomplete(document.getElementById("Titre"), passedArray);
			</script>
        </form>
    </div>
</section>

<section class="resultats">
	<?php
	$titre = $_POST['Titre'];
	$categorie = "AND categorie = '".$_POST['Categorie']."'";
	$sql = "SELECT * FROM dvd WHERE titre LIKE '%$titre%' ".$categorie;
	$dvd = recup_dvd_sql ($sql);
	afficher_dvd($dvd);
	?>
</section>