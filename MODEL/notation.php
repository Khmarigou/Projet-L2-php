<?php

function cree_table_notation(){
    global $c;
    $sql = "CREATE TABLE IF NOT EXISTS Notation (
        idNote INT AUTO_INCREMENT,
        idUs INT,
        idDvd INT,
        isNote BOOLEAN,
        CONSTRAINT pk_notation PRIMARY KEY (idNote),
        CONSTRAINT fk_user_film FOREIGN KEY (idUs) REFERENCES user (idUser),
        CONSTRAINT fk_dvd_film FOREIGN KEY (idDvd) REFERENCES Dvd (id)
        )";
    $result = mysqli_query($c, $sql);
}

function star(){
    echo "<i class='star' data-note='1'>&#9733;</i>";
    echo "<i class='star' data-note='2'>&#9733;</i>";
    echo "<i class='star' data-note='3'>&#9733;</i>";
    echo "<i class='star' data-note='4'>&#9733;</i>";
    echo "<i class='star' data-note='5'>&#9733;</i>";
    echo "<i class='note'> Note : </i>";
    echo "<script src='JS/star.js'></script>"; 
}

?>