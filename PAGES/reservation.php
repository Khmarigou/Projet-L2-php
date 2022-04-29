<?php

//$db = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
//$db = mysqli_connect("localhost", "root", "", "l2_info_11");

$sql = "CREATE TABLE Reservation(
    idDvd INT NOT NULL,
    idLocataire INT NOT NULL,
    dateDebut DATE,
    dateFin DATE,
    CONSTRAINT Fk_Reservation_Dvd FOREIGN KEY (idDvd) REFERENCES Dvd(id),
    CONSTRAINT Fk_Reservation_User FOREIGN KEY (idLocataire) REFERENCES User(idUser))";
    
    $result = mysqli_query($db, $sql);

if(isset($_GET['id'])){
    $id = $_GET['id'];
        echo "<form method='POST' action='MODEL/reserve.php' enctype='multipart/form-data' value='id'>";
        echo "<input type='text' name='id' value='$id' disabled='disabled'/>";
        echo "<label>Date de début : </label>";
        echo "<input type='date' name='debut'/></br>";
        echo "<label>Date de Fin : </label>";
        echo "<input type='date' name='fin'/></br>";
		echo "<p><input type='submit' name='location' value='location'/></p></form>";
}


?>
