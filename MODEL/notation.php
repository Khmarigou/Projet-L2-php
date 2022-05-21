<?php

function cree_table_notation(){
    global $c;
    $sql = "CREATE TABLE IF NOT EXISTS Notation (
        idNote INT AUTO_INCREMENT,
        idUs INT,
        idDvd INT,
        note INT,
        CONSTRAINT pk_notation PRIMARY KEY (idNote),
        CONSTRAINT fk_user_film FOREIGN KEY (idUs) REFERENCES User (idUser),
        CONSTRAINT fk_dvd_film FOREIGN KEY (idDvd) REFERENCES Dvd (id)
        )";
    $result = mysqli_query($c, $sql);
}

function star(){
    echo "<form method='POST' action='MODEL/notation.php'>";
    echo "<input type='submit' name='note' class='note' value = 1 />";
    echo "<input type='submit' name='note' class='note' value = 2 />";
    echo "<input type='submit' name='note' class='note' value = 3 />";
    echo "<input type='submit' name='note' class='note' value = 4 />";
    echo "<input type='submit' name='note' class='note' value = 5 />";
    $idDvd = $_GET['id'];
    echo "<input type='hidden' name='idDvd' class='note' value = $idDvd />";
    echo "</form>";
}



if(isset($_POST["note"])){
    session_start();
    $c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
    $idUs = $_SESSION["id"];
    $note = intval($_POST["note"]);
    $idDvd = $_POST['idDvd'];

    $sql = "SELECT * FROM notation WHERE idUs = $idUs AND idDvd = $idDvd";
    $result = mysqli_query($c, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row == NULL){
        $sql = "INSERT INTO Notation (idUS, idDvd, note) VALUE ($idUs, $idDvd, $note)";
        $result = mysqli_query($c, $sql);
        ajoutePoints($isUs,10);
    }else{
        $sql = "UPDATE notation SET note = $note WHERE idUs = $idUs AND idDvd = $idDvd";
        $result = mysqli_query($c, $sql);
    }
    header('Location: ../index.php?page=dvd_detail&id='.$idDvd);
    }

?>