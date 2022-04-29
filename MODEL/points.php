<?php

/**
    Récupère le nombre de points d'un utilisateur.
    @param $user : l'id de l'utilisateur.
    @return $points : le nombre de points de l'utilisateur.
 */
function getPoints($user){

    global $c;

    $sql = "SELECT points FROM User WHERE id=$user";
    $result = mysqli_query($c,$sql);

    $points = mysqli_fetch_assoc($result)["points"];

    return $points;
}

/**
    Modifie le nombre de points d'un utilisateur.
    @param $user : l'id de l'utilisateur.
    @param $points : le nombre de points à rajouter ou enlever
    @return $modif : si les points on été modifié.
*/
function ajoutePoints($user,$points){

    global $c;
    $modif = false;

    $userPoints = getPoints($user);

    $newPoints = $userPoints + $points;
        
    if($newPoints < 0){
        $newPoints = 0;
    }
        $sql = "UPDATE  User SET points =$newPoints WHERE id=$user";
        $res = mysqli_query($c,$sql);


    $modif = true;

    return $modif;
}

?>