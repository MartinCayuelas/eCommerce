<?php

//Controle

$imprimanteHTML = htmlspecialchars($i->getModele());



//Affiche
echo 'Modèle : ' . $imprimanteHTML;



$p = $i->getPrix();
$g = $i->getGamme();
$d = $i->getDimension();
$po = $i->getPoids();

echo <<<EOF


 <p> 
  Caracteristiques -->
 </p>
 <p>    
     Prix: $p €
 </p>
 <p> 
    Dimensions : $d cm 
  </p>
 <p>  
     Poids : $po Kg
 </p>
 <p>
     Gamme : $g 
 </p>
        
  

EOF;

echo '<img class="imgProduit" src="./images/upload/' . $i->getModele() . '" alt="Photo de montagne" />';
