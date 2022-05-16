<?php
   //creer_table_dvd();
    if(isset($_SESSION["username"])){
       posterAnnonce();
      
    }else{
       echo "<div class='location'>";
       echo "<h2>Vous devez être connecté(e) pour pouvoir louer vos DVD</h2>";
       echo "<a href='.?page=connexion'><li>Cliquer ici pour vous connecter</li></a>";
       echo "</div>";
    } 
    

?>