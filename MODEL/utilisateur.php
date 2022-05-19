<?php

function modifie_mot_de_passe_utilisateur($id, $ancien_mot_de_passe, $mot_de_passe, $confirmation) {
    global $bdd;
    $res = false;

    $sql = "SELECT mdp FROM Utilisateur WHERE id=$id";
    $result=mysqli_query($bdd, $sql);
    $correctAncienMdp = mysqli_fetch_assoc($result)["mdp"];
    $ancien_mot_de_passe_slashes = addslashes($ancien_mot_de_passe);
    $hash_acienmdpslashes = addslashes($ancien_mot_de_passe_slashes);
    $hash_acienmdp=crypt($ancien_mot_de_passe_slashes,"cledehashage");
    $hash_acienmdpslashes_crypt = addslashes($hash_acienmdp);
    if ($correctAncienMdp == $hash_acienmdpslashes_crypt and $mot_de_passe == $confirmation){
        $hashNewPassword = addslashes($mot_de_passe);
        $hashNewPasswordcrypt=crypt($hashNewPassword,"cledehashage");
        $sql ="UPDATE Utilisateur SET mdp = '$hashNewPasswordcrypt' WHERE id = $id";
        var_dump($sql);
        
        $res = mysqli_query($bdd, $sql);
    }

    return $res;
}

?>