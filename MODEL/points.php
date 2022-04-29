<?php

/**
    Modifie le nombre de points d'un utilisateur.
    @param $user : l'id de l'utilisateur.
    @param $points : le nombre de points à rajouter ou enlever
    @return $modif : si les points on été modifié.
*/
function ajoutePoints($user,$points){

    global $c;
    $modif = false;

    $sql = "UPDATE User u SET points = u.points + $points WHERE idUser=$user";

    $res = mysqli_query($c,$sql);


    $modif = true;

    return $modif;
}

?>