<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DVD Share</title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<link rel="stylesheet" type="text/css" href="CSS/style_tel.css" />
		<link rel="stylesheet" type="text/css" href="CSS/utilisateur.css" />
		<link rel="stylesheet" href="CSS/bootstrap.min.css">
    	<link rel="stylesheet" href="fontawesome/css/all.min.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	</head>
	<body>
 	
		<header>

            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href=".?page=suggestion">
                        <i class="fas fa-film mr-2"></i>
                        DVD Share
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-1 active" aria-current="page" href=".?page=suggestion">Explorer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-2" href=".?page=louer">Louer</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link nav-link-2" href=".?page=testDate">Date</a>
                        </li> -->


                        <!-- <li class="nav-item">
                            <a class="nav-link nav-link-3" href=".?page=demander">Demander</a>
                        </li> -->
            
                        <?php
                            if(isset($_SESSION["username"])){
                                echo "<li class='nav-item'><a  class='nav-link nav-link-5' href='index.php?page=profil'>Mon compte</a></li>";
                                echo "<li class='nav-item'><a  class='nav-link nav-link-6' href='index.php?page=deconnexion'>Déconnexion</a></li>";
                            }
                            else{
                                echo "<li class='nav-item'><a  class='nav-link nav-link-4' href='index.php?page=connexion'>Connexion</a></li>";
                            }
                            ?>
                    </ul>
                    </div>
                </div>
            </nav>

	    </header>
		<?php 
			if (isset($_GET['page'])) {
				include "PAGES/".$_GET['page'].".php";
			} else {
				include "PAGES/suggestion.php";
			}
		?>



		<footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About DVD Share</h3>
                    <p>DVD Share est une plateforme en ligne de location de DVD entre particulier.</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">Liens utiles</h3>
                    <ul class="tm-footer-links pl-0">
                        <li><a href="#">Support</a></li>
                        <li><a href=".?page=connexion">Connexion</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                        <li class="mb-2"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                        <li class="mb-2"><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li class="mb-2"><a href="https://pinterest.com"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                    <a href="#" class="tm-text-gray text-right d-block mb-2">Terms of Use</a>
                    <a href="#" class="tm-text-gray text-right d-block">Privacy Policy</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                    Copyright 2022 Praujet. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

	<script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

	</body>
</html>