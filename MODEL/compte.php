<?php	


$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
if (isset($_POST['changement'])){
		session_start();
		if (!empty($_POST['actual']) AND !empty($_POST['new'])  ){

			if(password_verify($_POST['actual'], $_SESSION["password"])){

					$new=password_hash($_POST["new"], PASSWORD_DEFAULT);

					$sql="UPDATE `user` SET `password` = '".$new."'  WHERE `idUser` = '". $_SESSION['id']."'";
					$result=mysqli_query($c,$sql);
				}
		}
		
		header('Location: ../index.php?page=profil');
	}



function affichePoint(){
		global $c;
		$sql='SELECT * FROM User WHERE idUser= "'.$_SESSION["id"].'"';
		$result=mysqli_query($c, $sql);
		$tab=mysqli_fetch_array($result);
		echo " <p> Vous possédez ";
		print_r($tab[6]); 
		echo" points </p>";
	}
	

			
			

			

	

	



?>
