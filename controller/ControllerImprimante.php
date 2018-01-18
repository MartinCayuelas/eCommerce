<?php

class ControllerImprimante {

    public static function readAllImprimantes() {
        $tab_i = ModelImprimante::getAllImprimantes();
        if (is_null($tab_i)) {
            $controller = 'imprimante';
            $view = 'listVide';
            $pagetitle = 'Liste des imprimantes';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'imprimante';
            $view = 'list';
            $pagetitle = 'Liste des Imprimantes';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function read() {
        $id = $_GET['modele'];


        $i = ModelImprimante::getImprimanteById($id);

        if ($i == false) {
            $controller = 'imprimante';
            $view = 'error';
            $pagetitle = '404 not Found';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'imprimante';
            $view = 'detail';
            $pagetitle = 'Detail du Produit';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createImprimante() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $controller = 'imprimante';
            $view = 'createImprimante';
            $pagetitle = 'Formulaire d\'imprimante';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdImprimante() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            if (!empty($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                // $name = $_FILES['image']['name'];
                $name = $_POST['modeleImprimante'];
                $pic_path = FILE::build_path(array("images", "upload", $name));
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $pic_path)) {
                    echo "La copie a échoué";
                }
            }

            $d = new ModelImprimante($_POST['modeleImprimante'], $_POST['prix'], $_POST['dimension'], $_POST['poids'], $_POST['gamme']);
            if ($d->save() == false) {
                $controller = 'produit';
                $view = 'error';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                $controller = 'imprimante';
                $view = 'createdImprimante';
                $pagetitle = 'Imprimante ajoutée';
                require FILE::build_path(array("view", "view.php"));
            }
        }
    }

    public static function delete() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $m = $_GET['modele'];
            $model = ModelImprimante::getImprimanteById($m);
            ModelProduit::deleteProduitsByImprimante($m);
            if ($model === false) {
                $controller = 'imprimante';
                $view = 'error';
                $pagetitle = 'Pas d\'imprimante';
                require File::build_path(array("view", "view.php"));
            } else {
                $model->deleteByModel();
                $controller = 'imprimante';
                $view = 'delete';
                $pagetitle = 'Supprime';
                require File::build_path(array("view", "view.php"));
            }
        }
    }

}
