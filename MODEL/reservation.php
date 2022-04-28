<?php

$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

$sql = "CREATE TABLE Reservation(
    idDvd INT NOT NULL,
    idLocataire INT NOT NULL,

    dateDebut Date NOT NULL,
    dateFin Date NOT NULL,

    CONSTRAINT Fk_Reservation_Dvd FOREIGN KEY (idDvd) REFERENCES Dvd(id),

    CONSTRAINT Fk_Reservation_User FOREIGN KEY (idLocataire) REFERENCES User(idUser)
    )";
    
    "

?>