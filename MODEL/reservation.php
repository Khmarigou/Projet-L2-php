<?php

//$db = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
//$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
$db = mysqli_connect("localhost", "root", "", "l2_info_11");

$sql = "CREATE TABLE Reservation(
    idDvd INT NOT NULL,
    idLocataire INT NOT NULL,
    dateDebut DATE,
    dateFin DATE,
    CONSTRAINT Fk_Reservation_Dvd FOREIGN KEY (idDvd) REFERENCES Dvd(id),
    CONSTRAINT Fk_Reservation_User FOREIGN KEY (idLocataire) REFERENCES User(idUser))";
    
    $result = mysqli_query($db, $sql);


// // function reserve(){
// //     global $c ;
//     $id = $_POST["louer"];
//     $sql = "SELECT * FROM Dvd WHERE id = $id";    
//     $result = mysqli_query($db, $sql);
//     while($row = mysqli_fetch_assoc($result)){
// 		$list[] = $row;
//     }
//     afficher_dvd($list);
// //}
?>
