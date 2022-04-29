
<?php
$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
if(isset($_POST["location"])){
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES (1,10,$deb,$fin)";
    $result = mysqli_query($db, $sql);
    var_dump($deb); var_dump($fin);
    var_dump($sql);var_dump($result);
}
?>