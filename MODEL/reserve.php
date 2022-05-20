
<?php

include_once "logs.php";
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
    - si tu réserves par dessus la réservation de quelqu'un qui a moins de points, celui qui en a le moins gagne des points
    - plus la durée de réservation est longue, plus tu perds des points
        - resa < 4 jours = perd 0pt
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

date_default_timezone_set("Europe/Paris");

//prend deux dates en string, et renvoit si la première est plus grande que la deuxième
function isBiggerDate($date1,$date2){
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);

    return $d1 > $d2;

}

//fonction qui dit si la date en entrée et au moins 2jours de plus qu'aujourd'hui
function isTwoDaysAfter($dateDebut){
    //on met la date en entré en temps
    $d = strtotime($dateDebut);

    //on crée le temps, qui est l'heure actuelle, mais en enlevant 
    //les heures, les mins et les sec en trop
    // on veut j+2 à 00:00:00 heure
    $mtn = time();
    $ajdPlus2j = $mtn + (2 * 24 * 60 * 60) ;

    //on récupère le temps en trop
    $heureTrop = date("H:i:s", $ajdPlus2j);
    $tempsTrop = explode(":",$heureTrop);

    $heure = intval($tempsTrop[0]) * 60 * 60;
    $min = intval($tempsTrop[1]) * 60;
    $sec = intval($tempsTrop[2]);

    $trop = $heure + $min+ $sec;

    //on met à jour j+2 avec le temps en trop
    $ajdPlus2j = $ajdPlus2j -  $trop ;


    return $d >= $ajdPlus2j;
}

function isYourDvd($idUser,$idDvd){
    global $c;
    $trouve = false;

    $sql = "SELECT id FROM Dvd WHERE proprio=$idUser";
    $res = mysqli_query($c,$sql);
    var_dump($sql);
    
    while(($row = mysqli_fetch_assoc($res)) && !$trouve){
        
        if($row['id'] == $idDvd){
            $trouve = true;
        }
    }

    return $trouve;

}


//fonction qui prend trois dates en entrées, et dis si la premère et entre les deux autres
function isDateIn($date, $dateInf, $dateSupp){
    $d = strtotime($date);
    $dI = strtotime($dateInf);
    $dS = strtotime($dateSupp); 

    return ($d >= $dI) && ($d <= $dS);

}

//fonction qui supprime la reservation d'un utilisateur
function supprimeReservation($user, $film){
    global $c;
    $sql = "DELETE FROM `reservation` WHERE `idDvd`= $film AND `idLocataire` = $user";
    $res = mysqli_query($c, $sql);

    return $res;
}

if(isset($_POST["location"])){

    

    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];
    //$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");



    if(isBiggerDate($deb,$fin)){
        /* $message = "Impossible de réserver : les dâtes ne sont pas cohérentes." ;
        printPHP($message); */
        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(!isTwoDaysAfter($deb)){
        /* $message = "Impossible de réserver : vous devez réserver au moins deux jour à l'avance." ;
        printPHP($message); */
        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }elseif(isYourDvd($idUser,$idDvd)){
        /* $message = "Impossible de réserver : vous ne pouvez pas réserver votre propre DVD." ;
        printPHP($message); */
        header('Location: ../index.php?page=dvd_detail&id='.$idDvd);

    }else{
        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
        $result = mysqli_query($db, $sql);

        header('Location: ../index.php?page=suggestion');
    }
   

    
}


?>