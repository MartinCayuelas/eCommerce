<?php
require_once File::build_path(array("lib", "fonctions-panier.php"));

creationPanier();
if (count($_SESSION['panier']['modeleImprimante']) != 0) {

    for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {
        $modele = $_SESSION['panier']['modeleImprimante'][$i];
        $couleur = $_SESSION['panier']['Couleur'][$i];
        $prix = $_SESSION['panier']['Prix'][$i];
        $quantité = $_SESSION['panier']['Quantité'][$i];
        $total = MontantGlobal();


        echo '<p>  Article ';
        echo '<a class="produitLien" HREF = "index.php?action=read&modele=' . $modele .
        '&couleur=' . $couleur . '&controller=produit">' . $modele . ' (' . $couleur . ')' . '</a>';
        echo ' x' . $quantité . ' à ' . $prix . '€/u (' .
        $quantité * $prix . '€) ';
        echo ' <a   HREF = "index.php?action=addQuantite&position=' . $i .
        '&controller=panier">'
        . '<img class="imgPanier" src="./images/addPanier.png" alt="Supprimer" onmouseover="this.src = \'./images/addPanier2.png\';" onmouseout="this.src = \'./images/addPanier.png\';"/></a>';
        echo ' <a   HREF = "index.php?action=removeQuantite&position=' . $i .
        '&controller=panier">'
        . '<img class="imgPanier" src="./images/removePanier.png" alt="Supprimer" onmouseover="this.src = \'./images/removePanier2.png\';" onmouseout="this.src = \'./images/removePanier.png\';"/></a>';
        echo ' <a class="produitLien" HREF = "index.php?action=removeArticle&position=' . $i .
        '&controller=panier">'
        . '<img class="imgPanier" src="./images/deletePanier.png" alt="Supprimer" onmouseover="this.src = \'./images/deletePanier2.png\';" onmouseout="this.src = \'./images/deletePanier.png\';"/></a>';
    }

    
    echo '<p>  Montant total : ' . $total . '€ <br> <br>';
    
    echo '<div class="Option"><a class="create" HREF = "index.php?controller=panier&action=removePanier"> Vider le panier </a></div>';
    echo '<div class="Option"><a class="create" HREF = "index.php?controller=commande&action=commander"> Commander </a></div>';
} else {
    echo '<p> Le panier est vide';
}