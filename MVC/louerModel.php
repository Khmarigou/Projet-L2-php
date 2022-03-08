<?php

//cree la table



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




$sql = "insert into adherent(surname,name,birthdate,licence_level,gender,mail,ranked,hand,backhand)
values('$surname','$name','$mail',$birth,$sexe,$hand,'$licence','$ranked',$bHandd)";
mysqli_query($connexion,$sql);

}

?>