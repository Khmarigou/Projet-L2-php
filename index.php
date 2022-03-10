<?php
session_start();

// Base de données
include_once "db.php";

// Modèle
include_once "MVC/modele.php";

include_once "MVC/louerModel.php";
include_once "MVC/locationMod.php";


// Controleur
include_once "MVC/action.php";

// Vue
include_once "MVC/louerView.php";
include_once "MVC/view.php";

?>