<?php
	$titre = $_POST['Titre'];
	$sql = "SELECT * FROM Dvdtest WHERE titre=$titre";
	header ('Location: ../?page=resultats&sql='.$sql);
?>