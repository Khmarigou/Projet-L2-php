<?php

include_once "../praujet/MODEL/logs.php";

$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
$id = $_GET['id'];


$sql3="SELECT titre FROM Dvd WHERE id=$id";
$result3 = mysqli_query($db,$sql3);
$row = mysqli_fetch_assoc($result3);
$titre = $row["titre"];

$sql="DELETE FROM Notation WHERE idDvd = $id";
$result = mysqli_query($db,$sql);

$sql4 = "SELECT * FROM Reservation WHERE idDvd=$id";
$res = mysqli_query($db,$sql4);
$row = mysqli_fetch_assoc($res);

$sql5 = "SELECT titre FROM Dvd INNER JOIN Reservation ON Dvd.id = Reservation.idDvd WHERE idDvd = $id";
$res = mysqli_query($db,$sql5);
$row_titre = mysqli_fetch_assoc($res);

if(!empty($row)){
    foreach ($row as $key => $value) {
        $message = "Votre réservation pour le film ". $row_titre['titre'] . " du " . $row['dateDebut'] . " au " .  $row['dateFin'] . " à été annulé car le film à été supprimé";
        ajoutLog($value, $message);
    }
}

$sql6 = "SELECT idUser FROM User INNER JOIN Dvd ON User.idUser = Dvd.proprio";
$res_proprio = mysqli_query($db,$sql6);
$row_proprio = mysqli_fetch_assoc($res_proprio);


if(!empty($row_proprio)){
    foreach ($row_proprio as $key => $value) {
        $message = "Votre film ". $titre . " à été supprimé par un administrateur.";
        ajoutLog($value, $message);
    }
    
    
}

$sql= "DELETE FROM Reservation WHERE idDvd=$id";
$sql2= "DELETE FROM Dvd WHERE id=$id";

$result = mysqli_query($db,$sql);
$result2 = mysqli_query($db,$sql2);

header('Location: ../praujet/index.php?page=suggestion');

if($result){
    
    $message = "Vous avez supprimé le film \"".$titre." \".";
    ajoutLog($_SESSION["id"], $message);
}

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