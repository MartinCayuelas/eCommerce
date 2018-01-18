<!DOCTYPE html>
<div class="form-style-5">
    <form method="post" action="index.php?action=created&controller=produit" >
        <fieldset>
           <span class ="titreform"><legend>Création d'un produit</legend></span>
            <p>
                <label for="mod_id">Modele d'imprimante</label> <br>
                <select name="modeleImprimante" id="mod_id">
                    <?php
                    $tab = ModelImprimante::getAllImprimantes();
                    foreach ($tab as $imp) {
                        echo "<option value=" . $imp->getModele() . ">" . $imp->getModele() . "</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="col_id">Couleur</label> 
                <input type="text" placeholder="Ex : bleu,vert..." name="Couleur" id="col_id" required/>
            </p>
            <p>
                <label for="quant_id">Quantite</label> 
                <input type="number" name="Quantite" id="quant_id"  required/>
            </p>

            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
