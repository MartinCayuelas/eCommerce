<?php

//Controle
$imprimanteHTML = htmlspecialchars($v->getImprimante());
$couleurHTML = htmlspecialchars($v->getCouleur());
$qHTML = htmlspecialchars($v->getQuantite());
$pHTML = htmlspecialchars($i->getPrix());
$gHTML = htmlspecialchars($i->getGamme());
$dHTML = htmlspecialchars($i->getDimension());
$poidHTML = htmlspecialchars($i->getPoids());
$impHTML = htmlspecialchars($i->getModele());

//Affiche
echo 'Imprimante ' . $imprimanteHTML . ' de couleur ' . $couleurHTML;




echo <<<EOF
 <p> 
   Il reste <span class="quantite">$qHTML </span> exemplaire(s) en stock
 </p>
 <p> 
  <span class="carac">Caracteristiques : </span> 
 </p>
 <p>    
     Prix: $pHTML €
 </p>
 <p> 
    Dimensions : $dHTML cm 
  </p>
 <p>  
     Poids : $poidHTML Kg
 </p>
 <p>
     Gamme : $gHTML 
 </p>


        
EOF;

echo '<img class="imgProduit" src="./images/upload/' . $i->getModele() . '" alt="Photo de montagne" />';

//echo '<div class="Option"><a class="create" href=index.php?action=ajoutArticle&controller=panier> Ajouter au panier</a></div>';
echo <<<EOF
   <form action = "index.php?action=ajoutArticle&controller=panier" method = "POST"> 
   <div>
    <input type = "hidden" name = "modele" value = $imprimanteHTML>
    <input type = "hidden" name = "couleur" value = $couleurHTML>
    <input type = "hidden" name = "prix" value = $pHTML>
    </div>
    <div class = "button">
    <button type = "submit">Ajouter au panier</button>
    </div>


    </form >
EOF;


if (isset($_SESSION['login']) && $_SESSION['admin'] == '1') {
    echo '<h2> Ajouter ou retirer du stock </h2>';
    echo <<<EOF
    <form action = "index.php?action=stock&controller=produit" method = "POST">
    <div>
    <label for = "quantite">Ajout / Retrait :</label>
    <input type = "number" id = "id_quantite" name = "quantite"/>
    </div>
    <div>
    <input type = "hidden" name = "modele" value = $imprimanteHTML>
    <input type = "hidden" name = "couleur" value = $couleurHTML>
    <input type = "hidden" name = "prix" value = $pHTML>
    </div>
    <div class = "button">
    <button type = "submit">Valider</button>
    </div>


    </form >
EOF;
}
