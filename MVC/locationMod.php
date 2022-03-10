<?php
	global $c;

	$id = $_POST["louer"];
	$sql = "UPDATE Dvd SET dispo = 0 WHERE id = $id";
// var_dump($sql);
	$result = mysqli_query($c,$sql);
// var_dump($result);
header('Location: ../index.php?page=suggestion');
	
?>