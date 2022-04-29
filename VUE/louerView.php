<?php
function posterAnnonce(){
?>

    <article>

        <h2>Louer votre DVD</h2>
        <form method="POST" action="MODEL/louerModel.php" enctype="multipart/form-data">
            
            
            <p><label>Titre du film</label> <input type="text" name="titre"></p><br>

            <p><label>Catégorie</label>
                <select name="genre">
                    <option value="">--Choisir une option--</option>
                    <option value="Action">Action</option>
                    <option value="Anime">Anime</option>
                    <option value="Comedie">Comédie</option>
                    <option value="Documentaire">Documentaire</option>
                    <option value="Drame">Drame</option>
                    <option value="Fantastique">Fantastique</option>
                    <option value="Horreur">Horreur</option>
                    <option value="Musical">Musical</option>
                    <option value="Policier">Policier</option>
                    <option value="SF">Science-Fiction</option>
                    <option value="Autres">Autres</option>

                </select></p><br>

            <p><label>Résumé</label> <input type="text" name="resume"></p><br>

            <p><label for="file">Fichier</label><input type="file" name="file"></p><br>

            <p><input type="submit" name="louer" value="Ajouter"/></p>
        </form>
    </article>

<?php
}

?>