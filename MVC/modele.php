
<!-- Gestion connection admin -->
<?php
if(isset($_POST["login"])){
	session_start();
	if(!empty($_POST['username']) AND !empty($_POST['password']))
	{
		$db = mysqli_connect("localhost", "l2","L2","BTM");
		$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
		$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
		
		$requete = "SELECT * FROM `users` WHERE `username` = '". $username ."' AND `password` = '". $password ."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse = mysqli_fetch_assoc($exec_requete);
		
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

function afficher_admin()
{	
	global $c;
	$sql = "SELECT * FROM `users`";
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
	if($_POST['username'] !== "" and $_POST['password'] !== ""){
		$sql = "INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES (NULL, '$_POST[username]', '$_POST[password]', 0);";
		$results = mysqli_query($c,$sql);
	}
	else{
		echo("champ vide.");
	}
}

function recup_dvd ()
{
	global $c;
	$sql = "SELECT * FROM Dvdtest";
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
		echo "<h2>".$value["Titre"]."</h2>";
		echo "<p><b>Realisateur : </b>".$value["Realisateur"]."</p>";
		echo "<p><b>Annee :</b> ".$value["Annee"]."</p>";
		echo "<p><b>Duree : </b>".$value["Duree"]." min</p>";
		echo "</article>";
		echo "</section>";
		}
	}
}

?>