
<?php
if(isset($_POST["location"])){
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES (1,2,$deb,$fin)";
    mysqli_query($db, $sql);
}
?>