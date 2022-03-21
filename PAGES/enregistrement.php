<?php 
$db=mysqli_connect("localhost","l2_info_11","Mei9shoh","User");
print_r($_POST);
$Prenom=$_POST["Prénom"];
$Nom=$_POST["Nom"];
$Nomdutilisateur=$_POST["Nom d'utiisateur"];
$Motdepasse=password_hash($_POST["Mot de passe"], PASSWORD_DEFAULT);
 $sql="INSERT INTO 'User' ('username', `password`) VALUES (`$login', '$passwordh')";
 echo "$sql";
 header('Location: ../index.php?page=suggestion');
?>