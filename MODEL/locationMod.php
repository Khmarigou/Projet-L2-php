<?php

//var_dump("coucou");
function louer(){
	global $c ;

	$id = $_POST["louer"];
	$sql = "UPDATE Dvd SET dispo = 0 WHERE id = $id";
//var_dump($sql);
	$result = mysqli_query($c,$sql);
//var_dump($result); exit;
	header('Location: ../index.php?page=suggestion');
}
?>