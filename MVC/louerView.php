<?php
function posterAnnonce(){
?>

    <article>

        <h2>Louer votre DVD</h2>
        <form method="post" action="louer.php">
            
            
            <p><label>Titre du film</label> <input type="text" name="titre"></p><br>

            <p><label>Catégorie</label>
                <select name="genre">
                    <option value="">--Choisir une option--</option>
                    <option value="0">Action</option>
                    <option value="1">Anime</option>
                    <option value="2">Comédies</option>
                    <option value="3">Documentaires</option>
                    <option value="4">Drames</option>
                    <option value="5">Fantastique</option>
                    <option value="6">Horreur</option>
                    <option value="7">Musical</option>
                    <option value="8">Policier</option>
                    <option value="9">Science-Fiction</option>

                </select></p><br>

            <p><label>Résumé</label> <input type="text" name="resume"></p><br>

            <! label pour mettre une image >

            <p><label>Durée location</label> <input type="date" name="location"></p><br>

            <p><input type="submit" name="louer" value="Ajouter">
        </form>
    </article>

<?php
}

?>