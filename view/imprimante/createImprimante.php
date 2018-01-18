<!DOCTYPE html>
<div class="form-style-5">
    <form method="post" action="index.php?action=createdImprimante&controller=imprimante" enctype="multipart/form-data" >
        <fieldset>
             <span class ="titreform"><legend>Création d'une imprimante</legend></span>

            <p>
                <label for="modele_id">Modele d'imprimante</label> 
                <input type="text" name="modeleImprimante" id="modele_id" required/>

            </p>
            <p>
                <label for="prix_id">Prix</label> 
                <input placeholder="euros" type="number" name="prix" id="prix_id" required/>
            </p>
            <p>
                <label for="dimension_id">Dimensions</label> 
                <input placeholder="cm*cm" type="text" name="dimension" id="dimension_id" required/>
            </p>
            <p>
                <label for="poids_id">Poids</label> 
                <input placeholder="gramme" type="number" name="poids" id="poids_id" required/>
            </p>
            <p>
                <label for="gamme_id">Gamme</label> 
                <input type="text" name="gamme" id="gamme_id" required/>
            </p>
            <p>
                <label for="img_id">Image du produit</label> 
                <input type="file" name="image" id="img_id" required/>
            </p> 
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
