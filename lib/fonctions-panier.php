<?php

require_once File::build_path(array("model", "ModelProduit.php"));

function creationPanier() {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['modeleImprimante'] = array();
        $_SESSION['panier']['Couleur'] = array();
        $_SESSION['panier']['Quantité'] = array();
        $_SESSION['panier']['Prix'] = array();
    }
    return true;
}

function ajouterArticle($modeleImprimante, $Couleur, $Quantité, $Prix) {

    //Si le panier existe
    if (creationPanier()) {
        //Si le produit existe déjà on ajoute seulement la quantité
        $position = false;
        for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {
            if ($_SESSION['panier']['modeleImprimante'][$i] == $modeleImprimante && $_SESSION['panier']['Couleur'][$i] == $Couleur) {
                $position = $i;
            }
        }

        if ($position != false) {
            $_SESSION['panier']['Quantité'][$position] += $Quantité;
        } else {
            //Sinon on ajoute le produit
            //array_push($_SESSION['panier']['modeleImprimante'], $modeleImprimante);
            //array_push($_SESSION['panier']['Couleur'], $Couleur);
            //array_push($_SESSION['panier']['Quantité'], $Quantité);
            //array_push($_SESSION['panier']['Prix'], $Prix);
            $pos = count($_SESSION['panier']['modeleImprimante']);
            $_SESSION['panier']['modeleImprimante'][$pos] = $modeleImprimante;
            $_SESSION['panier']['Couleur'][$pos] = $Couleur;
            $_SESSION['panier']['Quantité'][$pos] = $Quantité;
            $_SESSION['panier']['Prix'][$pos] = $Prix;
        }
        return true;
    } else {
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        return false;
    }
}

function supprimerArticle($i) { //$i est la position de l'article a supprimer
    //Si le panier existe
    if (creationPanier()) {
        //Nous allons passer par un panier temporaire
        
                unset($_SESSION['panier']['modeleImprimante'][$i]);
                $_SESSION['panier']['modeleImprimante'] = array_values($_SESSION['panier']['modeleImprimante']);

                unset($_SESSION['panier']['Couleur'][$i]);
                $_SESSION['panier']['Couleur'] = array_values($_SESSION['panier']['Couleur']);

                unset($_SESSION['panier']['Prix'][$i]);
                $_SESSION['panier']['Prix'] = array_values($_SESSION['panier']['Prix']);

                unset($_SESSION['panier']['Quantité'][$i]);
                $_SESSION['panier']['Quantité'] = array_values($_SESSION['panier']['Quantité']);

                /* array_splice($_SESSION['panier']['modeleImprimante'], $i, 1);

                  array_splice($_SESSION['panier']['Couleur'], $i, 1);

                  array_splice($_SESSION['panier']['Prix'], $i, 1);

                  array_splice($_SESSION['panier']['Quantité'], $i, 1); */

                
          return true;
    } else {
        return false;
    }
}

function getTabArticle() {
    if (creationPanier()) {

        $tabArticle = array();
        for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {
            $article = ModelProduit::getProduitByModeleCouleur($_SESSION['panier']['modeleImprimante'][$i], $_SESSION['panier']['Couleur'][$i]);
            $tabArticle[$i] = $article;
        }

        return $tabArticle;
    }
}

function modifierQTeArticle($position, $quantite) {
    //Si le panier éxiste
    if (creationPanier()) {
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($quantite > 0) {
            $_SESSION['panier']['Quantité'][$position] = $quantite;
            return true;

            /*
              $positionProduit = array_search($modeleImprimante, $_SESSION['panier']['modeleImprimante']);

              if ($positionProduit !== false) {
              $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
              } */
        } else {
            supprimerArticle($position);
            return true;
        }
    } else {
        return false;
    }
}

function MontantGlobal() {
    $total = 0;
    if (creationPanier()) {
        for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {
            $total += $_SESSION['panier']['Quantité'][$i] * $_SESSION['panier']['Prix'][$i];
        }
        return $total;
    }
}

function supprimePanier() {
    unset($_SESSION['panier']);
    creationPanier();
}

function removeStock(){
    if (creationPanier()) {
        for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {
            $modele = $_SESSION['panier']['modeleImprimante'][$i];
            $couleur = $_SESSION['panier']['Couleur'][$i];
            $quantite = 0 - $_SESSION['panier']['Quantité'][$i];
            $produit = ModelProduit::getProduitByModeleCouleur($modele, $couleur);
            if($produit->incrementeStockProduit($quantite) == true){
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}
