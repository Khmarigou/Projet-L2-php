<?php
    include_once "reserve.php";
/**
    Modifie le nombre de points d'un utilisateur.
    @param $user : l'id de l'utilisateur.
    @param $points : le nombre de points à rajouter ou enlever
    @return $modif : si les points ont été modifiés.
*/
function ajoutePoints($user,$points){

    global $c;
    $modif = false;

    $sql = "UPDATE User u SET points = u.points + $points WHERE idUser=$user";

    $res = mysqli_query($c,$sql);
    if($points == 1){
        $message = "Vous avez gagné " . $points . " point.";
    }
    else{
       $message = "Vous avez gagné " . $points . " points.";
    }
    ajoutLog($user, $message);

    $modif = true;

    return $modif;
}

/**
    Ajoute le nombre de points pour une location de Dvd
    @param $user : l'id de l'utilisateur.
    @return $modif : si les points ont été modifiés 

*/
function ajoutePointsLocation ($user) {
    global $c;
    $sql = "SELECT COUNT(*) FROM Dvd WHERE proprio = $user";
    $result = mysqli_query($c, $sql);
    $row = mysqli_fetch_assoc($result);
    $nbReservation = intval($row['COUNT(*)']);
    if ($nbReservation == 0) {
        $modif = ajoutePoints($user, 50);
    } else {
        $modif = ajoutePoints ($user, 10);
    }
    return $modif;
}

function affichePoints($user){
    global $c;
    $sql = "SELECT `points` FROM User WHERE idUser = $user";
    $result = mysqli_query($c, $sql);
    $row = mysqli_fetch_assoc($result);
    $res = $row['points'];
    
    return $res;
}

function inactif($user){
    recupereLogs($user);
    var_dump($value['jour']);
    exit;
}

?>