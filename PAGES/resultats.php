<section class="recherche">
<script type = "text/javascript" src="./JS/recherche.js"></script> 	
	
	<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="./IMAGES/hero.jpg">
        <form class="d-flex tm-search-form" action="./?page=resultats" method="POST" autocomplete="off">
			<?php
				$sql = "SELECT titre FROM Dvd";
				$listeTitres = recup_dvd_sql ($sql);
				foreach ($listeTitres as $key => $value) {
					$Titres[] = $value['titre'];
				}
			?>
            <input class="form-control tm-search-input" aria-label="Search" id='Titre' type='text' placeholder='Titre' name='Titre'>
			<select name='Categorie' id='Categorie'>
        <option value=''>Catégorie</option>
        <?php
            $sql = "SELECT DISTINCT categorie FROM Dvd";
            $listeCategorie = recup_dvd_sql($sql);
            foreach ($listeCategorie as $key => $value) {
                echo "<option value='".$value["categorie"]."'> ".$value["categorie"]." </option>";
            }
        ?>
        </select>
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
	if($_POST['Categorie'] == ""){
		$categorie = "";
	}
	else{
		$categorie = "AND categorie = '".$_POST['Categorie']."'";
	}
	
	$sql = "SELECT * FROM Dvd WHERE titre LIKE '%$titre%' ".$categorie;
	$dvd = recup_dvd_sql ($sql);
	?>
	<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
			<?php 
			if($_POST['Categorie'] == ""){
				echo "résultats pour : <span style='font-style: italic; font-weight: bold;'>" . "$titre ". "</span>";	
			}
			else if($_POST['Titre'] == "") {
				echo "résultats pour la catégorie <span style='font-style: italic;font-weight: bold;'>". $_POST['Categorie']."</span>";
			}
			else{
				echo "résultats pour : <span style='font-style: italic; font-weight: bold;'>" . "$titre ". "</span> dans la catégorie <span style='font-style: italic;font-weight: bold;'>". $_POST['Categorie']."</span>";
			}	
			?>
                 
            </h2>
        </div>
        <?php
			afficher_dvd($dvd);
		?>
        
    </div> 
</section>