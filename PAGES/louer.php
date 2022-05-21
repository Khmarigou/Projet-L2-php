<?php
   //creer_table_dvd();
   if(isset($_SESSION["username"])){
      global $c;
      $sql = "SELECT * FROM `Dvd` WHERE `proprio` = '". $_SESSION["id"] ."' ";
      $result = mysqli_query($c, $sql);
      if ($result) {
         while($row = mysqli_fetch_assoc($result))
            $mes_dvd[] = $row;
      }
      if (!isset($mes_dvd)) {
         $mes_dvd = array();
      }
      if($mes_dvd == null){
         posterAnnonce();
      }
      else{
         echo '<div class="conteneur"><div class="left">';
         posterAnnonce();
         echo '</div><div class="right">';
      
         
         affiche_mes_films($mes_dvd);
         echo "</div></div>";
      }

    }else{
       echo "<div class='location'>";
       echo "<h2>Vous devez être connecté(e) pour pouvoir louer vos DVD</h2><br>";
       echo "<a href='.?page=connexion' class='bouton_location'><li>Cliquer ici pour vous connecter</li></a>";
       echo "</div>";
    } 
    

?>