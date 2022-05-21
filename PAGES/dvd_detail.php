<?php 
$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
?>
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

<div class="container-fluid tm-container-content tm-mt-60">
    <!-- afficheUnFilm -->

    <?php

    if(isset($_SESSION['error'])){
        echo "<div class=\"erreur\">";
        echo $_SESSION['error'];
        echo "</div>";

        $_SESSION['error'] = null;
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM Dvd WHERE id = $id";
        $film = recup_dvd_sql($sql);
        afficher_film_test($film, $id);

    }

    ?>

                                                                        

    <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">
            Films similaires
        </h2>
    </div>
    
    <?php
    $dvdsim = recup_dvd_similaire();
    afficher_dvd($dvdsim);
    ?>

    <!-- <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">
            Films les mieux notés
        </h2>
    </div>
    
     <?php
    $dvdbest = recup_dvd_best();
    afficher_dvd($dvdbest);
    ?> --> 

</div> <!-- container-fluid, tm-container-content -->


<script src="js/plugins.js"></script>
<script>
    $(window).on("load", function() {
        $('body').addClass('loaded');
    });
</script>