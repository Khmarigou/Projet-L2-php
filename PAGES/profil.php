<?php
<?php


if(isset($_SESSION["username"])){

    echo "<li class='nav-item'><a href='index.php?page=logView'>Activités</a></li>";

    if($_SESSION["is_admin"] == 1){
        echo "<li class='nav-item'><a href='index.php?page=admin'>Modération</a></li>";
    }
    
}else{
    echo "Vous devez être connecté(e)."
}

?>