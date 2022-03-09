<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DVD Share</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style_tel.css" />

	</head>
	<body>
		<header>
			<div class="banniere">
				<a href=".?page=connexion"><img alt="connection" src="IMAGES/CONNECT.svg" id="connection"/></a>
				<h2>La location de DVD du futur</h2>
				<h1>DVD Share</h1>
				

			</div>
			<nav class="menu">
	            <ul>
	                <a href=".?page=suggestion"><li>Explorer</li></a>
	                <a href=".?page=louer"><li>Louer</li></a>
	                <a href=".?page=demander"><li>Demander</li></a>
					<?php
					if(isset($_SESSION["username"])){
						echo "<a href='index.php?page=admin'><li>Mon compte</li></a>";
						echo "<a href='index.php?page=deconnexion'><li>Déconnexion</li></a>";
					}
					else{
						echo "<a href='index.php?page=connexion'><li>Se connecter</li></a>";	
					}
					?>
            	</ul>
        	</nav>
		</header>
		<?php 
			if (isset($_GET['page'])) {
				include "PAGES/".$_GET['page'].".php";
			} else {
				include "PAGES/suggestion.php";
			}
		?>
		<footer>
			<p>&copy; Praujet</p>
		</footer>
	</body>
</html>