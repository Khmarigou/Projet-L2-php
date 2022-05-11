<?php

function afficheErreur($message){

    $texte = addslashes($message);

    echo "<script>";
    echo "alert('$texte');"; 
    echo "</script>";
}

$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

$sql = "CREATE TABLE Logs(
    idLog INT NOT NULL AUTO_INCREMENT,
    utilisateur INT NOT NULL,
    jour DATETIME DEFAULT CURRENT DATETIME,
    evenement VARCHAR(500),

    CONSTRAINT Pk_Logs PRIMARY KEY(idLog),
    CONSTRAINT Fk_Logs_User FOREIGN KEY (utilisateur) REFERENCES User(idUser))";

$result = mysqli_query($c,$sql);

?>