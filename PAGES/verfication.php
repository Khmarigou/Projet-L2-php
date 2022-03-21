<?php
//!\ requête sql objet 
$Nomdutilisateur=$_POST["Nom d'utiisateur"];
$Motdepasse=password_hash($_POST["Mot de passe"];
//$c=mysqli_connect("localhost","l2_info_11","Mei9shoh","User");
$result= $q = $c->query(
     "SELECT * FROM User
      WHERE username=$Nomdutilisateur
      ");
$valide=password_verify($Motdepasse, $result);
header('Location: ../index.php?page=suggestion');

?>
