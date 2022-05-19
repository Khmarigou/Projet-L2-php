
<?php
//$db = mysqli_connect("localhost", "root", "", "l2_info_11");
$db = mysqli_connect("localhost", "l2_info_11", "Mei9shoh", "l2_info_11");

$sql = "CREATE TABLE Reservation(
    idDvd INT NOT NULL,
    idLocataire INT NOT NULL,
    dateDebut DATE,
    dateFin DATE,
    CONSTRAINT Fk_Reservation_Dvd FOREIGN KEY (idDvd) REFERENCES Dvd(id),
    CONSTRAINT Fk_Reservation_User FOREIGN KEY (idLocataire) REFERENCES User(idUser))";
    
$result = mysqli_query($db, $sql);



//test :

/* C:\wamp64\www\WEB\praujet\CONTROLER\reserveControler.php:10:string '2022-05-03' (length=10)

C:\wamp64\www\WEB\praujet\CONTROLER\reserveControler.php:11:string '2022-05-10' (length=10) */

/* fonctions necessaires :

- affichage des réservations

- date fin > date début
- pas de reservation si c ton dvd
- pas de reserrvation si tu as déjà un dvd de réserver sur ces dates
- pas de reservation si un autre a plus de points

- possibilité de réserver si l'autre à moins de points
- il faut réserver deux jour à l'avance minimum (date début => date ajourd'hui + 2 jours) 

- si tu réserves par dessus la réservation de quelqu'un qui a moins de points, celui qui en a le moins gagne des points
- plus la durée de réservation est longue, plus tu perds des points
    - resa < 4 jours = perd 0pt
    - resa > 6 jours = perd 2 pts
    - resa > 14 jours = perd 4 pts


    
?>