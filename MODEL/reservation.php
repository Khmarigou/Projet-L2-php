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
    reserve();

    function reserve(){
        echo "<form method='POST' action='MODEL/reservation.php' enctype='multipart/form-data' value='id'>";
        echo "<label>Date de début : </label>";
        echo "<input type='date'/>";
		echo "<p><input type='submit' name='louer' value='Reserver'/></p></form>";
   }

    $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES "

?>
