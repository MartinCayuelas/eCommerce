
<?php
 echo'<h2 class= "titreform">Nos Imprimantes</h2>';
foreach ($tab_i as $i) {

 echo '</br>';
    echo '<a  class="linkImp" HREF = "index.php?action=read&modele=' . $i->getModele() .
    '&controller=imprimante">' . ' Imprimante modèle ' . $i->getModele() . '</a>';
    if (isset($_SESSION['login']) && $_SESSION['admin'] == '1') {
        echo' <a class="delete" HREF = "index.php?controller=imprimante&action=delete&modele=' . $i->getModele() . '"> supprimer</a>';
    }
    echo '</br>';
    echo '<a   HREF = "index.php?action=read&modele=' . $i->getModele() .
    '&controller=imprimante"><img class="imgProduit" src="./images/upload/' . $i->getModele() . '" alt=Picture not available/></a>';
    echo '</br>';
    echo '</br>';
}



if (isset($_SESSION['login']) && $_SESSION['admin'] == '1') {

    echo '<div class="Option" ><a class="create" HREF = index.php?action=createImprimante&controller=imprimante> Créer une imprimante </a></div>';
}



