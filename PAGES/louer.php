<?php
   //creer_table_dvd();
    if(isset($_SESSION["username"])){
       posterAnnonce();
      
    }else{
       echo "<div class='location'>";
       echo "<h2>Vous devez être connecté(e) pour pouvoir louer vos DVD</h2><br>";
       echo "<a href='.?page=connexion' class='bouton_location'><li>Cliquer ici pour vous connecter</li></a>";
       echo "</div>";
    } 
    

?>