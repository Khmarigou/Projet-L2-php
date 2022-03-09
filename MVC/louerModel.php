<?php

//cree la table


function creer_table_dvd(){
    global $c;
    $sql = "CREATE TABLE Dvd(
        id INT NOT NULL AUTO_INCREMENT,
        titre VARCHAR(50) NOT NULL,
        categorie ENUM ('Action','Anime','Comedie','Documentaire','Drame','Fantastique','Horreur','Musical','Policier','SF','Autres') NOT NULL,

        intrigue VARCHAR(1000) NOT NULL,
        duree DATE DEFAULT (CURRENT_DATE),

        CONSTRAINT Pk_Dvd PRIMARY KEY (id) )";
        

    //var_dump($sql);

    $result = mysqli_query($c, $sql);

    // proprio INT NOT NULL,
    //CONSTRAINT Fk_Dvd_Utilisateur UNIQUE (nomUtilisateur) )";

    return $result;
}


//ajoute dans la table


    if ( isset( $_POST['louer']) && $_POST['louer'] == 'Ajouter'){

        $bdd = mysqli_connect("localhost:3306", "l2_info_11", "Mei9shoh", "l2_info_11");

        $titre = $_POST['titre'];
        $categorie = $_POST['genre'];

        $intrigue = $_POST['resume'];
        $date = $_POST['location'];

        //$proprietaire = 3;

        //,proprio
        //,$proprietaire

        //$sql = "INSERT INTO Dvd(titre,categorie,intrigue,duree)
        //VALUES('$titre','$categorie','$intrigue',$date)";

        $sql = "INSERT INTO Dvd(titre,categorie,intrigue,duree) VALUES('$titre','$categorie','$intrigue','$date')";
        var_dump($sql);

        mysqli_query($bdd,$sql);
        header("Location: ../?page=recherche");

    }


?>