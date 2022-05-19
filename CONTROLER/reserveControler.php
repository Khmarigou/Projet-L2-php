<?php

if(isset($_POST["location"])){
    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];

    var_dump($deb);
    var_dump($fin);
    
    exit;

    $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
    $result = mysqli_query($db, $sql);
    var_dump($sql);
    var_dump($result);

    header('Location: ../index.php?page=suggestion');
}



?>