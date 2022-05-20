<?php



if(isset($_POST["location"])){

    

    session_start();
    $deb = $_POST['debut'];
    $fin = $_POST['fin'];
    $idDvd = $_POST['idDvd'];
    $idUser = $_SESSION['id'];
    $c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");



    if(isBiggerDate($deb,$fin)){
        $message = "Impossible de réserver : les dâtes ne sont pas cohérentes." ;
        printPHP($message);

    }elseif(!isTwoDaysAfter($deb)){
        $message = "Impossible de réserver : vous devez réserver au moins deux jour à l'avance." ;
        printPHP($message);

    }elseif(isYourDvd($idUser,$idDvd)){
        $message = "Impossible de réserver : vous ne pouvez pas réserver votre propre DVD." ;
        printPHP($message);

    }else{
        $sql = "INSERT INTO Reservation (idDvd, idLocataire, dateDebut, dateFin) VALUES ($idDvd,$idUser,'$deb','$fin')";
        $result = mysqli_query($c, $sql);
    }
   

    header('Location: ../index.php?page=suggestion');
}



?>