<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerImprimante.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerPanier.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));

if (isset($_GET['action']) == false) {
    $action = 'accueil';
    ControllerProduit::$action();
} else if ($_GET['controller'] == 'imprimante') {
    $action = $_GET['action'];
    ControllerImprimante::$action();
} else if ($_GET['controller'] == 'produit') {
    $action = $_GET['action'];
    ControllerProduit::$action();
} else if ($_GET['controller'] == 'utilisateur') {
    $action = $_GET['action'];
    ControllerUtilisateur::$action();
} else if ($_GET['controller'] == 'panier') {
    $action = $_GET['action'];
    ControllerPanier::$action();
} else if ($_GET['controller'] == 'commande') {
    $action = $_GET['action'];
    ControllerCommande::$action();
}





    