
<?php

$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
if(isset($_POST["location"])){
    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['idUser'];
        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
        $result = mysqli_query($db, $sql);
        var_dump($deb); var_dump($fin);
        var_dump($sql);var_dump($result);
        header('Location: ../index.php?page=suggestion');
    }
    
    
    
?>