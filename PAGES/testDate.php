

<section>

    <?php


        include_once "../praujet/MODEL/reserve.php";

        $id = $_SESSION['id'];

        $d1 = "2022-06-01";

        $d2 = "2022-06-30";

        $t = isAlreadyReserved($id);
        var_dump($t);


    ?>

</section>