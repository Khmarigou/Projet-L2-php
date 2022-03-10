<?php
	$c = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
    mysqli_set_charset($c, "utf8");

	$id = $_POST["louer"];
	$sql = "UPDATE Dvd SET dispo = 0 WHERE id = $id";
// var_dump($sql);
	$result = mysqli_query($c,$sql);
// var_dump($result);
header('Location: ../index.php?page=suggestion');
	
?>