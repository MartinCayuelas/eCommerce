<?php

require_once File::build_path(array("lib", "fonctions-panier.php"));
require_once File::build_path(array("model", "ModelCommande.php"));

class ControllerCommande {

    public static function readAllCommandes() {
        $login = $_SESSION['login'];
        $tab = ModelCommande::getAllCommandesByUser($login);
        if ($tab == FALSE) {
            $controller = 'commande';
            $view = 'listVide';
            $pagetitle = 'Liste des commandes';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'commande';
            $view = 'list';
            $pagetitle = 'Liste des commandes';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function read() {
        $id = $_GET['idCommande'];
        $v = ModelCommande::getCommandesById($id);

        if ($v == false) {
            $controller = 'commande';
            $view = 'error';
            $pagetitle = '404 not Found';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'commande';
            $view = 'detail';
            $pagetitle = 'Detail Commande';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function commander() {

        if (isset($_SESSION['login'])) {
            $login = $_SESSION['login'];
            for ($i = 0; $i < count($_SESSION['panier']['modeleImprimante']); $i++) {

                $id = 0;
                $modele = $_SESSION['panier']['modeleImprimante'][$i];
                $prix = $_SESSION['panier']['Prix'][$i];
                $couleur = $_SESSION['panier']['Couleur'][$i];
                $quantité = $_SESSION['panier']['Quantité'][$i];
                $date = date("Y-m-d");

                $v = new ModelCommande($modele, $couleur, $quantité, $prix, $login, $date, $id);

                $v->commander($login);
            }

            $tab = ModelCommande::getAllCommandesByUser($login);

            if ($v == false) {
                $controller = 'commande';
                $view = 'error';
                $pagetitle = '404 not Found';
                require File::build_path(array("view", "view.php"));
            } else {
                if (removeStock() == false) {
                    $controller = 'commande';
                    $view = 'error';
                    $pagetitle = '404 not Found';
                    require File::build_path(array("view", "view.php"));
                } else {
                    supprimePanier();

                    $controller = 'commande';
                    $view = 'commande';
                    $pagetitle = 'Commande enregistrée';

                    require File::build_path(array("view", "view.php"));
                }
            }
        } else {
            $b = "Connexion";
            $l = '';
            $n = '';
            $p = '';
            $m = '';
            $z = "Connexion";
            $controller = 'utilisateur';
            $view = 'connect';
            $pagetitle = 'Veuillez vous inscrire avant de commander';
            require File::build_path(array("view", "view.php"));
        }
    }

}
