<?php	


$c = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");
if (isset($_POST['password_update'])){
		session_start();

		if (!empty($_POST['old']) AND !empty($_POST['new']) AND !empty($_POST['confirm']) ){
			$sql1="SELECT * FROM User WHERE idUser = '".$_SESSION['id']."'";
			$result1=mysqli_query($c,$sql1);
			$tab=mysqli_fetch_assoc($result1);
			
			if(password_verify($_POST['old'], $tab['password'])){
				

				if ($_POST['new']==$_POST['confirm']){
					

					$new=password_hash($_POST["new"], PASSWORD_DEFAULT);

					$sql="UPDATE `user` SET `password` = '".$new."'  WHERE `idUser` = '". $_SESSION['id']."'";
					$result=mysqli_query($c,$sql);
				}
			}else{
				
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
