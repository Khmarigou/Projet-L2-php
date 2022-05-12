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
    jour DATETIME DEFAULT CURRENT_TIMESTAMP,
    activite VARCHAR(500),

    CONSTRAINT Pk_Logs PRIMARY KEY (idLog),
    CONSTRAINT Fk_Logs_User FOREIGN KEY (utilisateur) REFERENCES User(idUser))
";


$result = mysqli_query($c,$sql);


function ajoutLog($idUser,$log){

    global $c;

    $log = addslashes($log);

    $sql = "INSERT INTO Logs(utilisateur,activite) VALUES ($idUser,'$log')";
    $result = mysqli_query($c,$sql);

    return $result;

}

function afficheLogs($idUser){
    global $c;

    $sql = "SELECT jour, activite FROM Logs WHERE utilisateur = $idUser";
    $res = mysqli_query($c,$sql);
    
    echo "<div>";

    while($row = mysqli_fetch_assoc($res)){
 
        echo $row['jour'];
        echo " : " . $row['activite'];
        echo "<br>";
        
    }
        
    if($row == null){
        echo "Vous n'avez aucune activité. </br>";
    }

    echo "</di>";

}




?>