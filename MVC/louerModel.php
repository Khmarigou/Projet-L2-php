<?php

//cree la table

function cree_table_dvd() {

    global $bdd;
    $sql = "CREATE TABLE Dvd(
        id INT NOT NULL AUTO_INCREMENT,
        titre VARCHAR(50) NOT NULL,
        categorie INT NOT NULL,

        intrigue VARCHAR(1000) NOT NULL,
        duree DATE DEFAULT CURRENT_TIME,

        proprio INT NOT NULL,

        CONSTRAINT Pk_Dvd PRIMARY KEY (id),
        CONSTRAINT Fk_Dvd_Utilisateur UNIQUE (nomUtilisateur) )";

    $result = mysqli_query($bdd, $sql);
    // il reste les compétences et les niveaux 
    return $result;
}

//ajoute dans la table


if ( isset( $_POST['louer']) && $_POST['louer'] == 'Ajouter'){

$surname = $_POST['nom'];
$name = $_POST['prenom'];
$mail = $_POST['mail'];

$birth = $_POST['birthdate'];
$sexe = $_POST['genre'];
$hand = $_POST['main'];

$licence = $_POST['licence'];
$ranked = $_POST['rank'];
$bHand = $_POST['revers'];




$sql = "insert into Dvd(surname,name,birthdate,licence_level,gender,mail,ranked,hand,backhand)
values('$surname','$name','$mail',$birth,$sexe,$hand,'$licence','$ranked',$bHandd)";
mysqli_query($connexion,$sql);

}

?>