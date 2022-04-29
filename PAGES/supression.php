<?php

$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
$id = $_GET['$id'];
var_dump($id); exit;
$sql= "DELETE FROM Reservation WHERE idDvd=$id";
$sql2= "DELETE FROM Dvd WHERE id=$id";
$result = mysqli_query($db,$sql);
$result2 = mysqli_query($db,$sql2);
header('Location: ../praujet/index.php?page=suggestion');

/*if(isset($_POST["location"])){
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['id'];
    var_dump($idDvd); exit;
        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,1,'$deb','$fin')";
        $result = mysqli_query($db, $sql);
        var_dump($deb); var_dump($fin);
        var_dump($sql);var_dump($result);*/


?>