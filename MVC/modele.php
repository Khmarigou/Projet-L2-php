
<!-- Gestion connection admin -->
<?php

// global $c;
// $sql = "CREATE TABLE User(
//     id INT NOT NULL AUTO_INCREMENT,
//     nom VARCHAR(50) NOT NULL,
// 	prenom VARCHAR(50) NOT NULL,
// 	username VARCHAR(50) NOT NULL,
// 	password VARCHAR(50) NOT NULL,
// 	is_admin TINYINT,

//     CONSTRAINT Pk_Dvd PRIMARY KEY (id))";
 
// $result = mysqli_query($c, $sql); 



if(isset($_POST["login"])){
	session_start();
	if(!empty($_POST['username']) AND !empty($_POST['password']))
	{
		$db = mysqli_connect("localhost:3306", "l2_info_11", "Mei9shoh", "l2_info_11");
		$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
		$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
		$crypt_password=password_hash($password,PASSWORD_DEFAULT);
		$requete = "SELECT * FROM `User` WHERE `username` = '". $username ."' AND `password` = '". $crypt_password ."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse = mysqli_fetch_assoc($exec_requete);
		// $requete = "SELECT * FROM `User` WHERE `username` = '". $username ."' AND `password` = '". $password ."' ";
        // $exec_requete = mysqli_query($db,$requete);
        // $reponse = mysqli_fetch_assoc($exec_requete);
		
		if(!empty($reponse["username"]))
        {
			$_SESSION["username"] = $_POST['username'];
			$_SESSION["password"] = $_POST['password'];
			$_SESSION["is_admin"] = $reponse['is_admin'];
			header('Location: ../index.php?page=admin');

        }
		else
		{
			header('Location: ../index.php?page=connexion&error=1');
		}
	}
	else
	{
		header('Location: ../index.php?page=connexion&error=2');
	}
}

if(isset($_POST["register"])){
	session_start();
	if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['name']) AND !empty($_POST['surname']))
	{
		$db = mysqli_connect("localhost:3306", "l2_info_11", "Mei9shoh", "l2_info_11");
		$crypt_password=password_hash($_POST["password"], PASSWORD_DEFAULT);
		$sql = "INSERT INTO `User` (`id`, `nom`, `prenom`, `username`, `password`, `is_admin`) VALUES (NULL,'$_POST[surname]', '$_POST[name]', '$_POST[username]', '$crypt_password', 0);";
		$results = mysqli_query($db,$sql);

		header('Location: ../index.php?page=connexion');
	}
	else
	{
		header('Location: ../index.php?page=inscription&error=1');
	}
}

// if(isset($_POST["register"])){
// 	session_start();
// 	if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['name']) AND !empty($_POST['surname']))
// 	{
// 		$db = mysqli_connect("localhost:3306", "l2_info_11", "Mei9shoh", "l2_info_11");
// 		$sql = "INSERT INTO `User` (`id`, `nom`, `prenom`, `username`, `password`, `is_admin`) VALUES (NULL,'$_POST[surname]', '$_POST[name]', '$_POST[username]', '$_POST[password]', 0);";
// 		$results = mysqli_query($db,$sql);

// 		header('Location: ../index.php?page=connexion');
// 	}
// 	else
// 	{
// 		header('Location: ../index.php?page=inscription&error=1');
// 	}
// }


function afficher_admin()
{	
	global $c;
	$sql = "SELECT * FROM `User`";
	$results = mysqli_query($c,$sql);
	$row = mysqli_fetch_assoc($results);
	echo "<h2>Liste des administrateurs :</h2>";
	while($row != null) {
		echo "<article>\n";
		echo "<p>Pseudo : ".$row["username"]."</p>\n";
		echo "</article>\n";
		$row = mysqli_fetch_assoc($results);
	}
}

function creer_utilisateur()
{
	global $c;
	if($_POST['pseudo'] !== "" and $_POST['mdp'] !== ""){
		$sql = "INSERT INTO `User` (`id`, `username`, `password`, `is_admin`) VALUES (NULL, '$_POST[username]', '$_POST[password]', 0);";
		$results = mysqli_query($c,$sql);
	}
	else{
		echo("champ vide.");
	}
}

function recup_dvd ()
{

	global $c;
	$sql = "SELECT * FROM Dvd";
	$result = mysqli_query($c, $sql);

    while($row = mysqli_fetch_assoc($result))
		$list[] = $row;
	if (!isset($list)) {
		$list;
	}
	return $list;
}

function recup_dvd_sql ($sql) {
	global $c;
	$result = mysqli_query($c, $sql);
	$list = array();
    while($row = mysqli_fetch_assoc($result))
		$list[] = $row;
	if (!isset($list)) {
		$list;
	}
	return $list;
}




function afficher_dvd ($list)
{
	if ($list == null)
	{
		echo "<article><h2>Aucun résultat ne correspond à votre recherche.</h2></article>";
	} else {
		foreach ($list as $key => $value) {
			echo "<section class=film>";
			echo "<article>";
			echo "<h2>".$value["titre"]."</h2></br>";
			echo "<img src='./IMAGES/Locations/". $value["couverture"] . "' alt='img' class='img'/></br>";
			echo "<p><b>Categorie :</b> ".$value["categorie"]."</p></br>";
			echo "<p><b>Intrigue : </b>".$value["intrigue"]."</p></br>";
			if ($value["dispo"]==1){
				echo "<p id='dispo'><b>• DISPONIBLE</b></p>";
				$id = $value['id'];
				if(isset($_SESSION["username"])){
					echo "<form method='POST' action='MVC/locationMod.php' enctype='multipart/form-data'>";
					echo "<p><input type='submit' name='louer' value='$id'/></p></form>";
				 } 
			} else {
				echo "<p id='indispo'><b>• INDISPONIBLE</b></p>";
			}
			echo "</article>";
			echo "</section>";
		}
	}
	
}

?>