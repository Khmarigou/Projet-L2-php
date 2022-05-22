
<?php

include_once "logs.php";
include_once "points.php";

//$db = mysqli_connect("localhost", "root", "", "l2_info_11");
$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

$sql = "CREATE TABLE Reservation(
    idDvd INT NOT NULL,
    idLocataire INT NOT NULL,
    dateDebut DATE,
    dateFin DATE,
    CONSTRAINT Fk_Reservation_Dvd FOREIGN KEY (idDvd) REFERENCES Dvd(id),
    CONSTRAINT Fk_Reservation_User FOREIGN KEY (idLocataire) REFERENCES User(idUser))";
    
$result = mysqli_query($db, $sql);



//test :

/* C:\wamp64\www\WEB\praujet\CONTROLER\reserveControler.php:10:string '2022-05-03' (length=10)
C:\wamp64\www\WEB\praujet\CONTROLER\reserveControler.php:11:string '2022-05-10' (length=10) */

/* fonctions necessaires :


c fait : - date fin > date début
c fait : - il faut réserver deux jour à l'avance minimum (date début => date ajourd'hui + 2 jours)


- fonction dates dispos :
    - pas de reservation si c ton dvd
    - pas de reserrvation si tu as déjà un dvd de réserver sur ces dates
    - pas de reservation si un autre a plus de points


- fonction dates non dispos :
    - possibilité de réserver si l'autre à moins de points


- gestion points :
    - si tu réserves par dessus la réservation de quelqu'un qui a moins de points, celui qui en a 
    le moins gagne des points
    - plus la durée de réservation est longue, plus tu perds des points
        - resa < 4 jours = perd 0pt
        - resa > 4 jours = perd 1pt
        - resa > 6 jours = perd 2 pts
        - resa > 14 jours = perd 4 pts


- gestion alerte :
    - envoit un pop up alerte si dates résa impossible
         
    
- gestion logs :
    - bien envoyé tous les messages imporatants


- affichage des réservations disponibles pour chaque DVD
    - on affiche pas les dates < aujourd'hui
    - on affiche de couleurs différentes si c'est :
                                                - disponible
                                                - déjà reservé
                                                - réservé mais on peut réservé par dessus

*/



/* 
-------------------------------------------- Model pour l'ajout de reservation ---------------------------------------------------------------------------
 */
date_default_timezone_set("Europe/Paris");

//prend deux dates en string, et renvoit si la première est plus grande que la deuxième
function isBiggerDate($date1,$date2){
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);

    return $d1 > $d2;

}

//fonction qui prend un temps representant un jour
// et renvoit ce même jour mais àl'heure 00:00:00
function jourExacte($time){
    //on récupère le temps en trop
    $heureTrop = date("H:i:s", $time);
    $tempsTrop = explode(":",$heureTrop);

    $heure = intval($tempsTrop[0]) * 60 * 60;
    $min = intval($tempsTrop[1]) * 60;
    $sec = intval($tempsTrop[2]);

    $trop = $heure + $min+ $sec;

    $res = $time - $trop;
    return $res;
}

//fonction qui dit si la date en entrée et au moins 2jours de plus qu'aujourd'hui
function isTwoDaysAfter($dateDebut){
    //on met la date en entré en temps
    $d = strtotime($dateDebut);

    $ajdPlus2j = time() + (2 * 24 * 60 * 60);

    $jExacte = jourExacte($ajdPlus2j);

    return $d >= $jExacte;
}

function isYourDvd($idUser,$idDvd){
    global $c;
    $trouve = false;

    $sql = "SELECT id FROM Dvd WHERE proprio=$idUser";
    $res = mysqli_query($c,$sql);
    
    while(($row = mysqli_fetch_assoc($res)) && !$trouve){
        
        if($row['id'] == $idDvd){
            $trouve = true;
        }
    }

    return $trouve;

}


//fonction qui prend en entrée deux dates, et dis combien de jours
// il y a entre les deux
function countDays($debut,$fin){

    $td = strtotime($debut);
    $tf = strtotime($fin);

    $j = $tf - $td;
    $res = (($j / 24) / 60) / 60;

    return $res;
}

//fonction qui dit si la reservation dure plus de 20 jours
function isMoreTwentyDays($debut,$fin){

    $nbJ = countDays($debut,$fin);

    return $nbJ > 20;
}


//fonction qui prend en entrée deux dates de réservations, et
// renvoit le nombre de points à gagner ou perdre en fonction
// du nb de jour
function pointsReserve($debut,$fin){

    $jour = countDays($debut,$fin);

    if($jour <= 4){
        $pts = 0;
    }elseif( $jour < 6){
        $pts = -1;
    }elseif( $jour < 14){
        $pts = -2;
    }else{
        $pts = -4;
    }

    return $pts;
}


// function qui dis si le dvd est déjà réservé par l'utilisateur
//(pour ne pas réserver plusieurs fois d'affilé)
function isAlreadyReserved($idUser){

    $isReserved = false;
    global $c;

    $sql = "SELECT * FROM Reservation WHERE idLocataire = $idUser ORDER BY dateFin DESC";
    $res = mysqli_query($c,$sql);
    $row = mysqli_fetch_assoc($res);

    if(isset($row)){

        $dateFin = $row["dateFin"];
        $dt = strtotime($dateFin);

        $ajd = time();
        $jour = jourExacte($ajd);

        if($dt < $jour){
            $isReserved = false;
        }else{
            $isReserved = true;
        }
    }
    return $isReserved;
}


//fonction qui prend trois dates en entrées, et dis si la premère et entre les deux autres
function isDateIn($date, $dateInf, $dateSupp){
    $d = strtotime($date);
    $dI = strtotime($dateInf);
    $dS = strtotime($dateSupp); 

    return ($d >= $dI) && ($d <= $dS);
}


//renvoit toutes les réservations d'un film
function getResaFilm($idFilm){

    global $c;
    $tab = array();
    //Pour ne pas réserver par dessus quelqu'un dont la réservation est en cours,
    //on sélectionne toute les dates où la dates de fin est supérieure à aujourd'hui + 2 jours.

    //ensuite il reste un cas parmis toutes ces dates,
    //le cas où la date de début est avant aujourd'hui + 2jours à voir dans les fonctions qui suivent

    $fin = time() + (2 * 24 * 60 * 60);
    $dateFin = jourExacte($fin);

    $date = date("Y-m-d",$dateFin);

    $sql = "SELECT idLocataire, points, dateDebut, dateFin FROM Reservation INNER JOIN User ON User.idUser = Reservation.idLocataire WHERE idDvd = $idFilm AND dateFin > \"$date\" ORDER BY dateDebut";
    $res = mysqli_query($c,$sql);

    if($res){
        while($row = mysqli_fetch_assoc($res)){
            $tab[] = $row;
        }
    }
    
    return $tab;
}


//fonction qui renvoit une liste de réservation avec des conflits
function getConflitResa($idFilm,$debut,$fin){

    $conflits = array();
    $reservations = getResaFilm($idFilm);
 
    if(!empty($reservations)){
        foreach($reservations as &$resa){

            $d = $resa['dateDebut'];
            $f = $resa['dateFin'];
        
            //on regarde si la potentielle reservation est dans une autre, ou si elle est par dessus
            if(isDateIn($debut,$d,$f) || isDateIn($fin,$d,$f) || isDateIn($d,$debut,$fin) || isDateIn($f,$debut,$fin)){
                $conflits[] = $resa;
            }
        }
    }
    return $conflits;
}


//fonction qui di si un utilisateur à plus de points que l'autre
// user 1 a t-il plus de points
function haveMorePoints($user1,$user2){

    global $c;

    $sql = "SELECT idUser, points FROM User WHERE idUser = $user1 OR idUser = $user2";
    $res = mysqli_query($c,$sql);

    while($row = mysqli_fetch_assoc($res)){

        if($row["idUser"] == $user1){
            $pt1 = $row["points"];
        }elseif($row["idUser"] == $user2){
            $pt2 = $row["points"];
        }
    }
    return $pt1 > $pt2;
}


//fonction qui dit si la reservation est en cours
// $debut < (date de blockage = ajd +2j) < $fin
function isInProcess($debut,$fin){

    $jour = time() + (2 * 24 * 60 * 60);
    $j2 = jourExacte($jour);
    
    $d = strtotime($debut);
    $f = strtotime($fin);

    return ($d <= $j2) && ($f >= $j2); 
}


// fonction qui prend en paramètre les dates de début et de fin d'une réservation
// et dit si il est possible de réserver
// (on peut réserver, si il n'y a personne sur ces dates, ou si l'utlisateur à plus de points)
function isDateReservable($idFilm,$idUser,$debut,$fin){

    $conflits = getConflitResa($idFilm,$debut,$fin);

    if(empty($conflits)){
        $res = true;
    }else{
        //on regarde si chaque resa en conflit peuvent être
        //réservé par dessus sinon on arrête
        $res = true;
        $i = 0;
        while( ($i < sizeof($conflits)) && ($res) ){

            $id = $conflits[$i]["idLocataire"];

            $d = $conflits[$i]["dateDebut"];
            $f = $conflits[$i]["dateFin"];

            if( (!haveMorePoints($idUser,$id)) || (isInProcess($d,$f))){
                $res = false;
            }
            $i++;
        }
    }
    return $res;
}


//fonction qui supprime une réservation et met un log à un
//l'utilisateur qui n'a plus sa reservation
function supprimeResa($idDvd,$idUser,$message){

    global $c;

    $sql ="DELETE FROM Reservation WHERE idDvd = $idDvd AND idLocataire = $idUser";
    $res = mysqli_query($c,$sql);

    if($res){
        ajoutLog($idUser,$message);
    }
}


//fonction qui dit si l'utilisateur a déjà une réservation de n'importe quel dvd
function haveReserved($idUser){

    global $c;

    $limite = time() + (2 * 24 * 60 * 60);
    $dateFin = jourExacte($limite);

    $date = date("Y-m-d",$dateFin);

    $sql = "SELECT * FROM Reservation WHERE idLocataire = $idUser AND dateFin > \"$date\" ";
    $res = mysqli_query($c,$sql);
    $row = mysqli_fetch_assoc($res);

    if(!empty($row)){
        $already = true;
    }else{
        $already = false;
    }
    return $already;
}


/* 
-------------------------------------------- Model pour l'affichage des reservations ------------------------------------------------------------
*/


function afficheReservation($idDvd,$idUser){

    $points = affichePoints($idUser);
    $reservation = getResaFilm($idDvd);

    if(empty($reservation)){
        echo "<div>";
        echo "Il n'y a aucune réservation pour ce film, soyez le premier !";
        echo "</div>";
    }else{

        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Les dernières réservations : <th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($reservation as &$resa){
            echo "<tr>";
            

            if($resa["points"] >= $points){
                echo "<td class='orange'>". $resa["dateDebut"] ."</td>";
                echo "<td class='orange'>". $resa["dateFin"] ."</td>";
            }else{
                echo "<td class='vert'>". $resa["dateDebut"] ."</td>";
                echo "<td class='vert'>". $resa["dateFin"] ."</td>";
            }
            
            echo "</tr>";
        }
        echo "<tbody>";
        echo "</table>";
        echo "Vous ne pouvez pas réserver par dessus les dates en oranges, car vous n'avez pas assez de points !<br>";
    }
    return $points;

}









 /* 
-------------------------------------------- Controler pour la gestion des reservations ------------------------------------------------------------
 */

if(isset($_POST["location"])){

    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];
    $_SESSION['error'] = null;
    echo $idDvd;
    //$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");



    if(isYourDvd($idUser,$idDvd)){

        $message = "Impossible de réserver : vous ne pouvez pas réserver votre propre DVD." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(haveReserved($idUser)){

        $message = "Impossible de réserver : vous avez déjà une autre réservation dans les prochains jours." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(isAlreadyReserved($idUser)){

        $message = "Impossible de réserver : vous avez déjà réservé ce DVD dans les prochains jours." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(isBiggerDate($deb,$fin)){

        $message = "Impossible de réserver : les dates ne sont pas cohérentes." ;
        $_SESSION['error'] = $message;
        
        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(!isTwoDaysAfter($deb)){

        $message = "Impossible de réserver : vous devez réserver au moins deux jour à l'avance." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(isMoreTwentyDays($deb,$fin)){

        $message = "Impossible de réserver : votre réservation dépasse la durée maximale de 20 jours." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(isDateReservable($idDvd,$idUser,$deb,$fin)){

        //on récupère le titre du dvd
        $sql2 = "SELECT titre FROM Dvd WHERE id = $idDvd ";
        $res = mysqli_query($db, $sql2);
        $row_titre = mysqli_fetch_assoc($res);

        //on peut réserver, donc on supprime toutes les reservations en conflits
        $conflits = getConflitResa($idDvd,$deb,$fin);
        if(!empty($conflits)){
            foreach($conflits as &$resa){
                //on envoit un message à ceux qui n'ont plus de résa et on leur donne des points
                $message = "IMPORTANT ! Votre réservation pour le film ". $row_titre['titre'] . " du " . $deb . " au ". $fin . " à été annulé par la réservation d'un utilisateur avec plus de points.";
                supprimeResa($idDvd, $resa["idLocataire"],$message);
                ajoutePoints($resa["idLocataire"], 20);
            }
        }

        //on ajoute la reservation
        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
        $result = mysqli_query($db, $sql);

        
        if($result){
            //si la reservation a été ajouté, on envoit un message et on met à jour les points
            $message = "Vous avez reservé le film " . $row_titre['titre'] . " du " . $deb . " au " . $fin . ".";
            ajoutLog($_SESSION['id'], $message);

            $points = pointsReserve($deb,$fin);
            ajoutePoints($idUser,$points);
        }

        

        header('Location: ../index.php?page=suggestion');

    }else{

        $message = "Impossible de réserver : vous essayer peut-être de réserver par dessus quelqu'un qui a plus de points que vous." ;
        $_SESSION['error'] = $message;

        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);
    } 
}


?>