<?php
session_start();

// Base de données
include_once "db.php";

// Modèle
include_once "MODEL/points.php";
include_once "MODEL/modele.php";
include_once "MODEL/logs.php";

include_once "MODEL/louerModel.php";
include_once "MODEL/reserve.php";

include_once "MODEL/compte.php";

include_once "MODEL/notation.php";




// Controleur
include_once "CONTROLER/action.php";
//include_once "CONTROLER/reserveControler.php";

// Vue
include_once "VUE/louerView.php";
include_once "VUE/view.php";

?>