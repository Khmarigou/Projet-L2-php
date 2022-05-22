

<section>

    <?php


        include_once "../praujet/MODEL/reserve.php";
        include_once "../praujet/MODEL/calendrierResa.php";
        

        /* $d1 = "2022-05-24";
        $d2 = "2022-06-08";

        echo "Voici toutes les reservations récentes : <br>";
        $t = getResaFilm(10);
        var_dump($t);

        echo "<br>";

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

 
        /* if ($m == ""){ */
            
            $dateComponents = getdate();
            $month = $dateComponents['mon'];
            $year = $dateComponents['year'];
        /* } else {
        
            $month = $m;
            $year = $y;
        
        } */

        echo build_previousMonth($month, $year, "2");
        echo build_nextMonth($month,$year,"2");
        echo build_calendar($month,$year,array("2022-05-01","2022-05-02","2022-05-03"));


    ?>

</section>