<?php

/**
    Récupère le nombre de points d'un utilisateur.
    @param $user : l'id de l'utilisateur.
    @return le nombre de points de l'utilisateur.
 */
function getPoints($user){

    global $c;

    $sql = "SELECT points FROM User WHERE id=$user";
    $result = mysqli_query($c,$sql);

    $points = mysqli_fetch_assoc($result)["points"];

    return $points;
}

?>