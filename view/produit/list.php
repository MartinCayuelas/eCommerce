<?php
 echo'<h2 class= "titreform">Nos Produits</h2>';
foreach ($tab as $i) {
    echo '<p>  Imprimante ';
    echo '<a class="produitLien" HREF = "index.php?action=read&modele=' .$i->getImprimante().
    '&couleur=' . $i->getCouleur() . '&controller=produit">' . $i->getImprimante() . ' (' . $i->getCouleur() . ')' . '</a>';
   
    if (isset($_SESSION['login']) && $_SESSION['admin'] == '1') {
    echo' <a class="delete" HREF = "index.php?&action=delete&modele=' .$i->getImprimante(). 
    '&couleur=' .$i->getCouleur() . '&controller=produit"> supprimer</a>';
    }
}
echo '<br>';
echo '<br>';
if (isset($_SESSION['login']) && $_SESSION['admin'] == '1') {
echo '<a class="create" HREF = index.php?action=create&controller=produit> Créer un produit </a>';


}
