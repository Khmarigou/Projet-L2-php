<?php

//var_dump("coucou");
if(isset($_POST["louer"])){

	$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
	$id = $_POST["louer"];
	$sql = "UPDATE Dvd SET dispo = 0 WHERE id = $id";
//var_dump($sql);
	$result = mysqli_query($c,$sql);
//var_dump($result); 
	header('Location: ../.?page=location');
}
?>