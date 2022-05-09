<?php

function afficheErreur($message){

    $texte = "Erreur : " . $message;

    
    $texte = addslashes($texte);

    echo "<script>";
    echo "alert('$texte');";
    echo "</script>";
}
?>