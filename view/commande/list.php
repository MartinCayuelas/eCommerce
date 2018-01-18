<?php

foreach ($tab as $i) {
    echo '<p> Commande n° '.$i->getIdCommande().'('.$i->getCouleur().')';
    echo '<a class="produitLien" HREF = "index.php?action=read&idCommande='.$i->getIdCommande().'&controller=commande">'.'   ' . $i->getModeleImprimante().'</a>';
   
    
}
