
<section class='pageProfil'>

    <?php

    if(isset($_SESSION["username"])){

        echo "<h2 id='bonjour'>Bonjour " . $_SESSION["username"] .", vous êtes connecté.</h2>";

        echo "<li class='nav-item'><a href='index.php?page=logView'>Activités</a></li>";
        echo "<li class='nav-item'><a href='index.php?page=compte'>Mes informations</a></li>";

        if($_SESSION["is_admin"] == 1){
            echo "<li class='nav-item'><a href='index.php?page=admin'>Modération</a></li>";
        }
        
    }else{
        echo "Vous devez être connecté(e).";
    }

    ?>

</section>