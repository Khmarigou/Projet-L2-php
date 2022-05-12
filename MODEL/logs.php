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

function recupereLogs($idUser){
    global $c;

    $liste = array();

    $sql = "SELECT jour, activite FROM Logs WHERE utilisateur = $idUser";
    $res = mysqli_query($c,$sql);

    if($res){
        while($row = mysqli_fetch_assoc($res)){
            $liste[] = $row;
        }
    }

    return $liste;    
}


function afficheLogs($idUser){

    $liste = recupereLogs($idUser);

    echo "<div>";

    if($liste == null){
        echo "Vous n'avez aucune activité. </br>";
    }else{
        foreach($liste as $key => $value){
            echo $value['jour'] . " : " . $value['activite'] . "</br>";
        }
    }

    echo "</di>";
}

?>  