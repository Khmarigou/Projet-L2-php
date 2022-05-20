<?php


if(isset($_POST["location"])){
    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];
    $c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

    $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
    $result = mysqli_query($c, $sql);
   

    header('Location: ../index.php?page=suggestion');
}



?>