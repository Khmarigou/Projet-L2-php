<?php

include_once ('../praujet/MODEL/reserve.php');
include_once ('../praujet/MODEL/logs.php');
include_once ('../praujet/MODEL/points.php');

if(isset($_POST["location"])){

    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];
    $_SESSION['error'] = null;
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

        $conflits = getConflitResa($idDvd,$deb,$fin);
        if(!empty($conflits)){
            foreach($conflits as &$resa){
                $message = "IMPORTANT ! Votre réservation pour le film ". $row_titre['titre'] . " du " . $deb . " au ". $fin . " à été annulé par la réservation d'un utilisateur avec plus de points.";
                supprimeResa($idDvd, $resa["idLocataire"],$message);
                ajoutePoints($resa["idLocataire"], 20);
            }
        }

        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
        $result = mysqli_query($db, $sql);

        $sql2 = "SELECT titre FROM Dvd WHERE id = $idDvd ";
        $res = mysqli_query($db, $sql2);
        $row_titre = mysqli_fetch_assoc($res);
        
        if($result){
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