

<section>

    <?php


        include_once "../praujet/MODEL/reserve.php";
        

        $d1 = "2022-05-24";
        $d2 = "2022-06-08";

        echo "Voici toutes les reservations récentes : <br>";
        $t = getResaFilm(2);
        var_dump($t);

        afficheReservation(1,1);

        /* echo "<br>";

        echo "Voici toutes les reservations en conflits : <br>";
        $t2 = getConflitResa(10,$d1,$d2);
        var_dump($t2);

        $t4 = isInProcess('2022-05-24','2022-05-24');
        var_dump($t4);
        
        echo "<br>";

        echo "Voici le teste final : <br>";
        echo $d1 ."<br>";
        echo $d2 ."<br>";

        $teste = isDateReservable(10,7,$d1,$d2);
        var_dump($teste); */




    ?>

</section>