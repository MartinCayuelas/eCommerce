<?php

//Controle
$idHTML = htmlspecialchars($v->getIdCommande());
$imprimanteHTML = htmlspecialchars($v->getModeleImprimante());
$couleurHTML = htmlspecialchars($v->getCouleur());
$qHTML = htmlspecialchars($v->getQuantite());
$pHTML = htmlspecialchars($v->getPrix());
$dateHTML =  htmlspecialchars($v->getDate());






echo <<<EOF
<table>
   <tr>
       <th>idCommande</th>
       <th>Modele</th>
       <th>Couleur</th>
        <th>Quantité</th>
        <th>Prix</th>
        <th>Date</th>
   </tr>

   <tr>
       <td>$idHTML</td>
       <td>$imprimanteHTML</td>
       <td>$couleurHTML</td>
 
       <td>$qHTML</td>
       <td>$pHTML</td>
        <td>$dateHTML</td>
       
   </tr>
</table>


        
EOF;



echo '<a class="produitLien" HREF = "index.php?action=readAllCommandes&login='.$_SESSION['login'].'&controller=commande"> Retour</a>';