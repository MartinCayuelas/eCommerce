<?php

require_once File::build_path(array("model", "ModelProduit.php"));
require_once File::build_path(array("model", "ModelImprimante.php"));
require_once File::build_path(array("lib", "Session.php"));

class ControllerProduit {

    public static function readAll() {
        $tab = ModelProduit::getAllProduits();
        if (is_null($tab)) {
            $controller = 'produit';
            $view = 'listVide';
            $pagetitle = 'Liste des produits';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'produit';
            $view = 'list';
            $pagetitle = 'Liste des Produits';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function read() {
        $modele = $_GET['modele'];
        $couleur = $_GET['couleur'];
        $v = ModelProduit::getProduitByModeleCouleur($modele, $couleur);
        $i = ModelImprimante::getImprimanteById($modele);
        if ($v == false) {
            $controller = 'produit';
            $view = 'error';
            $pagetitle = '404 not Found';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'produit';
            $view = 'detail';
            $pagetitle = 'Detail du Produit';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function delete() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $modele = $_GET['modele'];
            $couleur = $_GET['couleur'];
            $d = ModelProduit::deleteByModeleCouleur($modele, $couleur);
            if ($d == false) {
                $controller = 'produit';
                $view = 'error';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {

                $controller = 'produit';
                $view = 'delete';
                $pagetitle = 'Succes';
                require File::build_path(array("view", "view.php"));
            }
        }
    }

    public static function create() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'produit';
            $view = 'create';
            $pagetitle = 'Formulaire d\'ajout de produit';

            require File::build_path(array("view", "view.php"));
        }
    }

    public static function created() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $p = new ModelProduit($_POST['modeleImprimante'], $_POST['Couleur'], $_POST['Quantite']);
            if ($p->save() == false) {
                $controller = 'produit';
                $view = 'error';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                $controller = 'produit';
                $view = 'created';
                $pagetitle = 'Produit ajouté';
                require FILE::build_path(array("view", "view.php"));
            }
        }
    }

    public static function stock() {
        $stock = $_POST['quantite'];
        $mod = $_POST['modele'];
        $coul = $_POST['couleur'];
        $v = ModelProduit::getProduitByModeleCouleur($mod, $coul);
        $id = $v->getImprimante();
        $i = ModelImprimante::getImprimanteByid($id);
        if ($v->incrementeStockProduit($stock) == true) {
            $controller = 'produit';
            $view = 'stock';
            $pagetitle = 'Stock modifié';
            require FILE::build_path(array("view", "view.php"));
        } else {
            $controller = 'produit';
            $view = 'error';
            $pagetitle = 'Erreur lors de la modification du stock';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public function accueil() {
        $controller = 'produit';
        $view = 'accueil';
        $pagetitle = 'Accueil';

        require File::build_path(array("view", "view.php"));
    }

}
