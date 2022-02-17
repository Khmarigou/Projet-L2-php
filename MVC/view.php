<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DVD Share</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<header>
			<div class="banniere">
				<h2>La location de DVD du futur</h2>
				<h1>DVD Share</h1>

			</div>
			<nav class="menu">
	            <ul>
	            	<a href=".?page=home"><li>Acceuil</li></a>
	                <a href=".?page=recherche"><li>Recherche</li></a>
	                <a href=".?page=louer"><li>Louer</li></a>
	                <a href=".?page=demander"><li>Demander</li></a>
            	</ul>
        	</nav>
		</header>
		<?php 
			if (isset($_GET['page'])) {
				include "PAGES/".$_GET['page'].".php";
			} else {
				include "PAGES/home.php";
			}
		?>
		<footer>
			
		</footer>
	</body>
</html>