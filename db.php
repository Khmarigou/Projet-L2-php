<?php


//Base local Emilien 
//$c = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
//Base local Paul
$c = mysqli_connect("localhost", "root", "", "l2_info_11");


//Base Serveur
$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

<<<<<<< HEAD

=======
//Base Serveur
//$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
>>>>>>> bd06e3cbe63a0c95bddc9dac1d2dba96ba69213b
mysqli_set_charset($c, "utf8");

?>