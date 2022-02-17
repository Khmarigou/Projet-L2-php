<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DVD Share</title>
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<header>
			<h1>DVD Share</h1>
			<nav class="menu">
	            <ul>
	                <a href=".?page=recherche"><li>Explorer</li></a>
	                <a href=".?page=louer"><li>Louer</li></a>
	                <a href=".?page=demander"><li>Demander</li></a>
					<a href=".?page=connexion"><li>Se connecter</li></a>
            	</ul>
        	</nav>
		</header>
		<!-- c'est qui ce mec ? -->
		
		<?php 
			if (isset($_GET['page'])) {
				include "PAGES/".$_GET['page'].".php";
			} else {
				include "PAGES/recherche.php";
			}
		?>
		<footer>
			Paul le chef
		</footer>
	</body>
</html>