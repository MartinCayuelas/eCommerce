<?php

require_once File::build_path(array("lib", "fonctions-panier.php"));

class ControllerPanier {

    public function readAll() {
        $controller = 'panier';
        $view = 'list';
        $pagetitle = 'Liste des Articles du panier';
        require File::build_path(array("view", "view.php"));
    }

    public function ajoutArticle() {
        $ajout = ajouterArticle($_POST['modele'], $_POST['couleur'], 1, $_POST['prix']);
        if ($ajout == true) {
            $controller = 'panier';
            $view = 'ajoute';
            $pagetitle = 'Ajout effectué';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'panier';
            $view = 'error';
            $pagetitle = 'Erreur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public function removeArticle() {
        $position = $_GET['position'];
        $supp = supprimerArticle($position);
        if ($supp == true) {
            $controller = 'panier';
            $view = 'list';
            $pagetitle = 'suppression effectué';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'panier';
            $view = 'error';
            $pagetitle = 'Erreur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public function addQuantite() {
        $i = $_GET['position'];
        if (modifierQTeArticle($i, $_SESSION['panier']['Quantité'][$i] + 1) == true) {
            $controller = 'panier';
            $view = 'list';
            $pagetitle = 'Quantité ajouté';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'panier';
            $view = 'error';
            $pagetitle = 'Erreur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public function removeQuantite() {
        $i = $_GET['position'];
        if (modifierQTeArticle($i, $_SESSION['panier']['Quantité'][$i] - 1) == true) {
            $controller = 'panier';
            $view = 'list';
            $pagetitle = 'Quantité ajouté';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'panier';
            $view = 'error';
            $pagetitle = 'Erreur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public function removePanier() {
        supprimePanier();
        $controller = 'panier';
        $view = 'list';
        $pagetitle = 'Suppression du panier';
        require File::build_path(array("view", "view.php"));
    }

}
