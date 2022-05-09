
<!-- Gestion connection admin -->
<?php

//$c = mysqli_connect("localhost", "root", "", "l2_info_11");
$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
$sql = "CREATE TABLE User(
    idUser INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(500) NOT NULL,
	is_admin INT,
	points INT DEFAULT(0),

    CONSTRAINT Pk_User PRIMARY KEY (idUser))";
 
$result = mysqli_query($c, $sql);


if(isset($_POST["login"])){
	session_start();
	
	if(!empty($_POST['username']) AND !empty($_POST['password'])){

		//$c = mysqli_connect("localhost", "root", "", "l2_info_11");
		$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
		$username = mysqli_real_escape_string($c,htmlspecialchars($_POST['username'])); 
		$password = mysqli_real_escape_string($c,htmlspecialchars($_POST['password']));

		$crypt_password=password_hash($password, PASSWORD_DEFAULT);
		$correct_password=password_verify($_POST['password'], $crypt_password);

		$requete = "SELECT * FROM `User` WHERE `username` = '". $username ."' ";
        $exec_requete = mysqli_query($c,$requete);
        $reponse = mysqli_fetch_assoc($exec_requete);

		if(!empty($reponse["username"])){

			$_SESSION["id"] = $reponse['idUser'];
			$_SESSION["username"] = $_POST['username'];
			$_SESSION["password"] = $_POST['password'];
			$_SESSION["is_admin"] = $reponse['is_admin'];
			header('Location: ../index.php?page=admin');
			

        }else{
			header('Location: ../index.php?page=connexion&error=1');
		}

	}else{
		header('Location: ../index.php?page=connexion&error=2');
	}
	
}

if(isset($_POST["register"])){
	session_start();
	if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['name']) AND !empty($_POST['surname'])){

		//$c = mysqli_connect("localhost", "root", "", "l2_info_11");
		$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
		$pseudo = "SELECT username FROM `User` WHERE `username` = '". $_POST['username'] ."' ";
		$pseudo_exist = mysqli_query($c, $pseudo);
		$row = mysqli_num_rows($pseudo_exist);

		if($row == 0){
			$crypt_password=password_hash($_POST["password"], PASSWORD_DEFAULT);
			$sql = "INSERT INTO `User` (`idUser`, `nom`, `prenom`, `username`, `password`, `is_admin`) VALUES (NULL,'$_POST[surname]', '$_POST[name]', '$_POST[username]', '$crypt_password', 0);";
			$results = mysqli_query($c,$sql);
			header('Location: ../index.php?page=connexion');
		}else{
			header('Location: ../index.php?page=inscription&error=1');	
		}
	}else{
		header('Location: ../index.php?page=inscription&error=2');
	}
}

function afficher_admin()
{	
	global $c;
	$sql = "SELECT * FROM `User` WHERE is_admin = 1";
	$results = mysqli_query($c,$sql);
	$row = mysqli_fetch_assoc($results);
	//echo "<h2>Liste des administrateurs :</h2>";
	while($row != null) {
		echo "<article>\n";
		echo "<p>Pseudo : ".$row["username"]."</p>\n";
		echo "</article>\n";
		$row = mysqli_fetch_assoc($results);
	}
}

function afficher_membres ()
{
	global $c;
	$sql = "SELECT * FROM User WHERE is_admin = 0";
	$results = mysqli_query($c,$sql);
	$row = mysqli_fetch_assoc($results);
	//echo "<h2>Liste des membres :</h2>";
	while($row != null) {
		echo "<article>\n";
		echo "<p>Pseudo : ".$row["username"]."</p>\n";
		echo "</article>\n";
		$row = mysqli_fetch_assoc($results);
	}
}

function afficher_ajout_admin()
{
	echo '<article>
			<h3>Ajouter un role administrateur</h3>
			<form action="index.php?page=admin" method="post">
			<div class="form">
				<p><select name="username" id="username">

	        	<option value="">--Selectionner L\'utilisateur--</option>';
	            $sql = "SELECT * FROM `User` WHERE is_admin = 0";
	            $listeUser = recup_dvd_sql($sql);
	            foreach ($listeUser as $key => $value) {
	                echo "<option value='".$value["username"]."'> ".$value["username"]." </option>";
	            }
				echo '</p>
				</select></br>
				<p><input type="submit" name="action" value="Ajouter"></p>
			</div>
			</form>
			</article>';
}

function afficher_suppr_admin() 
{
	echo '<article>
			<h3>Enlever un role administrateur</h3>
			<form method="post" action="index.php?page=admin">
				<p><select name="username" id="username">
        		<option value="">--Selectionner L\'utilisateur--</option>';
            $sql = "SELECT * FROM `User` WHERE is_admin = 1 AND username != '".$_SESSION['username']."'";
            $listeAdmin = recup_dvd_sql($sql);
            foreach ($listeAdmin as $key => $value) {
                echo "<option value='".$value["username"]."'> ".$value["username"]." </option>";
            }
			echo '</p>
			</select></br>
			<p><input type="submit" name="action" value="Enlever"></p>
			</form>
			</article>';
}

function afficher_suppr_membres() {
	echo '<article>
			<h3>Suppression d\'un utilisateur</h3>
			<form method="post" action="index.php?page=admin">
				<p><select name="username" id="username">
        		<option value="">--Selectionner L\'utilisateur--</option>';
            $sql = "SELECT * FROM `User` WHERE username != '".$_SESSION['username']."'";
            $listeMembres = recup_dvd_sql($sql);
            foreach ($listeMembres as $key => $value) {
                echo "<option value='".$value["username"]."'> ".$value["username"]." </option>";
            }
			echo '</p>
			</select></br>
			<p><input type="submit" name="action" value="Supprimer"></p>
			</form>
			</article>';
}

function supprimer_utilisateur(){
	
	global $c;
	$username = $_POST['username'];	
	$sql= "DELETE FROM `User` WHERE `username` = '$username'";
	mysqli_query($c,$sql);
}

function creer_admin()
{
	global $c;
	$username = $_POST['username'];
	if($username !== ""){
		$sql = "UPDATE User SET is_admin = 1 WHERE username = '$username'";
		$results = mysqli_query($c,$sql);
	}
	else{
		echo("champ vide.");
	}
}

function enlever_admin()
{
	global $c;
	$username = $_POST['username'];
	if($username !== ""){
		$sql = "UPDATE User SET is_admin = 0 WHERE username = '$username'";
		$results = mysqli_query($c,$sql);
	}
	else{
		echo("champ vide.");
	}
}

function creer_utilisateur()
{
	global $c;
	if($_POST['pseudo'] !== "" and $_POST['mdp'] !== ""){
		$sql = "INSERT INTO `User` (`username`, `password`, `is_admin`, `points`) VALUES ('$_POST[username]', '$_POST[password]', 0,200);";
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
	if ($result) {
	    while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
	}
	if (!isset($list)) {
		$list = array();
	}
	return $list;
}

function recup_dvd_sql ($sql) {
	global $c;
	$result = mysqli_query($c, $sql);
	$list = array();
	if ($result) {
	    while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
	}
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
		echo '<div class="row tm-mb-90 tm-gallery">';
		foreach ($list as $key => $value) {
        	echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">';
                echo '<figure class="effect-ming tm-video-item">';
		
                   	echo "<img src='./IMAGES/Locations/". $value["couverture"] . "' class='img-fluid'>";
                   	echo '<figcaption class="d-flex align-items-center justify-content-center">';
                    echo '<h2>'.$value["titre"].' </br><p><b>Categorie :</b> '.$value["categorie"].'</p><br><br><br></h2>';
					   
                    echo '</figcaption>';                 
                echo '</figure>';
                echo '<div class="d-flex justify-content-between tm-text-gray">';
                    echo '<span class="tm-text-gray-light">Disponible</span>';
					if(isset($_SESSION["username"])){
						$id = $value["id"];
						echo "<a href='index.php?page=reservation&id=$id'>Réserver</a>";
						if($_SESSION["is_admin"]==1){
							$id = $value["id"];
							echo "<a href='index.php?page=supression&id=$id'>Supprimer</a>";
						} 
					}
                    echo '<span>9,906 likes</span>';
                echo '</div>';
            echo '</div>';
		}
		echo '</div>'; 
	}
	
}
function afficher_film ($film){
	if ($film == null)
	{
		echo "<article><h2>Erreur.</h2></article>";
	} else {
		foreach ($film as $key => $value) {
			echo "<div class ='row tm-mb-90 tm-gallery'>
			<img src ='./IMAGES/Locations/".$value["couverture"]."' class='img-fluid'>
			<article> Titre : ".$value["titre"]." </article>
			<article> Intrigue ; ".$value["intrigue"]." </article>
			";
		}
	}
}

?>



<!--
		echo "<section class=film>";
			echo "<article>";
			echo "<h2>".$value["titre"]."</h2></br>";
			echo "<img src='./IMAGES/Locations/". $value["couverture"] . "' alt='img' class='img'/></br>";
			echo "<p><b>Categorie :</b> ".$value["categorie"]."</p></br>";
			echo "<p><b>Intrigue : </b>".$value["intrigue"]."</p></br>";

			if(isset($_SESSION["username"])){
				echo "<form method='POST' action='PAGES/reservation.php' enctype='multipart/form-data' value='id'>";
				echo "<p><input type='submit' name='louer' value='Reserver'/></p></form>";
			} 

			echo "</article>";
			echo "</section>";

		-->