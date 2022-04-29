<section class="recherche">
	<script type = "text/javascript" src="./JS/recherche.js"></script> 	
	
	<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="./IMAGES/banniere.jpg">
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

<section class="suggestion">
	<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Vos meilleurs recommendations
            </h2>
        </div>
        <?php
			afficher_dvd($dvd);
		?>
        
    </div> <!-- container-fluid, tm-container-content -->
	
</section>


<!--

<form action="./?page=resultats" method="POST" autocomplete="off">
			<?php

			/*

			$sql = "SELECT titre FROM dvd";
			$listeTitres = recup_dvd_sql ($sql);
			foreach ($listeTitres as $key => $value) {
				$Titres[] = $value['titre'];
			}

			*/

			?>
		<div class="autocomplete" >
		<input id='Titre' type='text' placeholder='Titre' name='Titre'>
		</div>
		<select name='Categorie' id='Categorie'>
	    <option value=''>Catégorie</option>
	    <?php
		/*
	    $sql = "SELECT DISTINCT categorie FROM dvd";
	    $listeCategorie = recup_dvd_sql($sql);
		foreach ($listeCategorie as $key => $value) {
			echo "<option value='".$value["categorie"]."'> ".$value["categorie"]." </option>";
		}
		*/
		?>
		</select>
        <input type="submit" name='recherche'  value='Rechercher'>
		<script type="text/javascript">
			var passedArray = <?php /* echo json_encode($Titres); */ ?>;
			autocomplete(document.getElementById("Titre"), passedArray);
		</script>
    </form>


-->