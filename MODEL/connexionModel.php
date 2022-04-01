<?php


function connexion()
{
    session_start();
    if(!empty($_POST['username']) AND !empty($_POST['password']))
    {
        global $c;
        var_dump($c);
        $username = mysqli_real_escape_string($c,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($c,htmlspecialchars($_POST['password']));
        $crypt_password=password_hash($password, PASSWORD_DEFAULT);
        $correct_password=password_verify($_POST['password'], $crypt_password);
        $requete = "SELECT * FROM `User` WHERE `username` = '". $username ."' ";
        $exec_requete = mysqli_query($c,$requete);
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

?>