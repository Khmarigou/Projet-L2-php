
<?php

include_once "logs.php";
include_once "points.php";


//cree la table

//function creer_table_dvd(){

    //global $c;
    //$c = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
    //$c = mysqli_connect("localhost", "root", "", "l2_info_11");
    $c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
    
    $sql = "CREATE TABLE Dvd(
        id INT NOT NULL AUTO_INCREMENT,
        proprio INT,
        titre VARCHAR(50) NOT NULL,
        categorie ENUM ('Action','Anime','Comedie','Documentaire','Drame','Fantastique','Horreur','Musical','Policier','SF','Autres') NOT NULL,
        couverture VARCHAR(100) NOT NULL,
        intrigue VARCHAR(1000) NOT NULL,
        
        CONSTRAINT Pk_Dvd PRIMARY KEY (id),
        CONSTRAINT Fk_Dvd_User FOREIGN KEY (proprio) REFERENCES User(idUser))";
        
    //var_dump($sql);

    $result = mysqli_query($c, $sql);

    //return $result;
//}

if ( isset( $_POST['louer']) && $_POST['louer'] == 'Ajouter'){

    //pour pouvoir utiliser le $_SESSION
    session_start();

    //$c = mysqli_connect("localhost", "l2", "L2", "l2_info_11");
    //$c = mysqli_connect("localhost", "root", "", "l2_info_11");
    $c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

    $idProprio = $_SESSION["id"];
    var_dump($idProprio);

    $titre = $_POST['titre'];
    $titre = addslashes($titre);
    
    $categorie = $_POST['genre'];

    
    
    $intrigue = $_POST['resume'];
    $intrigue = addslashes($intrigue);

    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    move_uploaded_file($tmpName, '../IMAGES/Locations/'.$name);

    $sql = "INSERT INTO Dvd(proprio,titre,categorie,couverture,intrigue)
    VALUES($idProprio,'$titre','$categorie','$name','$intrigue')";
    $ajout = mysqli_query($c,$sql);
    ajoutePointsLocation ($idProprio);

    if($ajout){
        $message = "Vous avez mis en location le film \"".$titre." \".";
        ajoutLog($_SESSION["id"], $message);
                
        printPHP("Votre film a bien été ajouté.");
    }


    header('Location: ../index.php?page=suggestion');

}
?>
