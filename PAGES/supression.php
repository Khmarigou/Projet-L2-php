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

$sql4 = "SELECT idLocataire FROM Reservation WHERE idDvd=$id";
$res = mysqli_query($db,$sql4);
$row = mysqli_fetch_assoc($res);
if(!empty($row)){
    foreach ($row as $key => $value) {
        $message = "Votre réservation à été annulé car le film n'est plus disponible";
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