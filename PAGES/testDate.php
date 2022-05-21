

<section>

    <?php


        include_once "../praujet/MODEL/reserve.php";

        $d1 = "2022-06-01";

        $d2 = "2022-06-30";

        $t = getResaFilm(9,$d1,$d2);
        var_dump($t);


    ?>

</section>