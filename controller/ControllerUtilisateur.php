<?php

require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("lib", "Security.php"));
require_once File::build_path(array("lib", "Session.php"));

class ControllerUtilisateur {

    public static function readAllUtilisateurs() {
        if (!Session::is_admin()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $tab_i = ModelUtilisateur::getAllUtilisateurs();
            $controller = 'utilisateur';
            $view = 'list';
            $pagetitle = 'Liste des Utilisateurs';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function read() {
        $id = $_GET['login'];

        if (!Session::is_admin() && !Session::is_user($id)) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $v = ModelUtilisateur::getUserByLogin($id);

            if ($v == false) {
                $controller = 'utilisateur';
                $view = 'error';
                $pagetitle = '404 not Found';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'utilisateur';
                $view = 'detail';
                $pagetitle = 'Detail Profil';
                require File::build_path(array("view", "view.php"));
            }
        }
    }

    public static function connect() {
        $controller = 'utilisateur';
        $view = 'connect';
        $pagetitle = 'Connectez-vous';
        require File::build_path(array("view", "view.php"));
    }

    public static function connected() {
        $crypt = Security::chiffrer($_POST['password']);
        $v = ModelUtilisateur::checkPassword($_POST['login'], $crypt);

        $login = $_POST['login'];
        if ($v != false) {
            $nonce = $v->getNonce2($login);

            if (is_null($nonce)) {
                if ($v != false) {


                    $_SESSION['admin'] = $v->getAdmin2($login);


                    $_SESSION['login'] = $_POST['login'];
                    $controller = 'utilisateur';
                    $view = 'detail';
                    $pagetitle = 'Informations personnelles';
                    require FILE::build_path(array("view", "view.php"));
                } else {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $pagetitle = 'Erreur de connexion';
                    require FILE::build_path(array("view", "view.php"));
                }
            } else {
                self::connect();
            }
        } else {
            $controller = 'utilisateur';
            $view = 'connect';
            $pagetitle = 'Erreur de connexion';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public static function deconnect() {
        session_destroy();
        $controller = 'utilisateur';
        $view = 'deconnected';
        $pagetitle = 'Deconnexion';
        require FILE::build_path(array("view", "view.php"));
    }

    public static function inscription() {
        
        if (isset($te) == false) {
            $b = "Creation";
            $l = '';
            $n = '';
            $p = '';
            $m = '';
            $z = "inscrit";
            $controller = 'utilisateur';
            $view = 'inscription';
            $pagetitle = 'Formulaire d\'ajout d\' utilisateur';
            require File::build_path(array("view", "view.php"));
        } else {

            $controller = 'utilisateur';
            $view = 'inscription';
            $pagetitle = 'Formulaire d\'ajout d\' utilisateur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function inscrit() {

        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {

            $te = 1;
            $b = "Inscription";
            $z = "inscrit";
            $m = 'ERREUR MAIL';
            $l = $_POST['login'];
            $n = $_POST['nom'];
            $p = $_POST['prenom'];
            $controller = 'utilisateur';
            $view = 'inscription';
            $pagetitle = 'Erreur E mail';
            require FILE::build_path(array("view", "view.php"));
        } else {

            if (($_POST['password'] == $_POST['confirmpass'])) {

                $chiffrer = Security::chiffrer($_POST['password']);
                $nonce = Security::generateRandomHex();
                $login = $_POST['login'];
                $m = '<a href ="http://infolimon/~gonzalezblancor/eCommerce/ProjetPhp/index.php?action=validate&controller=utilisateur&nonce=' . $nonce . '&login=' . $login . '">Cliquez-ici pour valider votre Incription</a>';
                $mail = $m;
                $p = new ModelUtilisateur($_POST['login'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $chiffrer, 0, $nonce);

                if ($p->save() == false || $login == 'ERREUR LOGIN') {
                    $te = 1;
                    $b = "Inscription";
                    $z = "inscrit";
                    $l = 'ERREUR LOGIN';
                    $n = $_POST['nom'];
                    $p = $_POST['prenom'];
                    $m = $_POST['email'];
                    $controller = 'utilisateur';
                    $view = 'inscription';
                    $pagetitle = 'Login existant';
                    require FILE::build_path(array("view", "view.php"));
                } else {

                    $to = $_POST['email'];
                    $subj = 'Inscription FoodPrinter';
                    $headers = null;
                    mail($to, $subj, $mail, $headers);
                    $controller = 'utilisateur';
                    $view = 'inscrit';
                    $pagetitle = 'Inscription réussie';
                    require FILE::build_path(array("view", "view.php"));
                }
            } else {

                $b = "Inscription";
                $z = "inscrit";
                $l = $_POST['login'];
                $n = $_POST['nom'];
                $p = $_POST['prenom'];
                $m = $_POST['email'];
                $te = 1;
                $controller = 'utilisateur';
                $view = 'inscription';
                $pagetitle = 'Erreur Mot de passe';
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


            $m = $_GET['login'];
            $login = ModelUtilisateur::getUserByLogin($m);
            if ($login === false) {
                $controller = 'utilisateur';
                $view = 'error';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                $login->deleteByLogin();
                $controller = 'utilisateur';
                $view = 'delete';
                $pagetitle = 'Supprime';
                require File::build_path(array("view", "view.php"));
            }
        }
    }

    public static function update() {
        if (!Session::is_connected()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $z = "updated";
            $b = "Modification du compte";
            $l = $_POST['login'];
            $n = $_POST['nom'];
            $p = $_POST['prenom'];
            $m = $_POST['mail'];
            $controller = 'utilisateur';
            $view = 'inscription';
            $pagetitle = 'Mise à jour compte';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public static function updated() {
        if (!Session::is_connected()) {
            $controller = 'produit';
            $view = 'accueil';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            if (($_POST['password'] === $_POST['confirmpass'])) {
                if (isset($_SESSION['admin'])) {
                    $v = new ModelUtilisateur($_POST['login'], $_POST['nom'], $_POST['prenom'], $_POST['email'], Security::chiffrer($_POST['password']), 0, Security::generateRandomHex());
                    if ($p = $v->updated($_POST['exlogin']) === false) {
                        $controller = 'utilisateur';
                        $view = 'error';
                        $pagetitle = 'Erreur lors de la modification';
                        require FILE::build_path(array("view", "view.php"));
                    } else {
                        $controller = 'utilisateur';
                        $view = 'detail';
                        $pagetitle = 'Accueil';
                        require FILE::build_path(array("view", "view.php"));
                    }
                } else {
                    if ($_POST['admin'] == '1') {
                        $ad = 1;
                    } else {
                        $ad = 0;
                    }
                    $v = new ModelUtilisateur($_POST['login'], $_POST['nom'], $_POST['prenom'], $_POST['email'], Security::chiffrer($_POST['password']), 0, Security::generateRandomHex());
                    if ($p = $v->updated($_POST['exlogin']) === false) {
                        $controller = 'utilisateur';
                        $view = 'error';
                        $pagetitle = 'Erreur lors de la modification';
                        require FILE::build_path(array("view", "view.php"));
                    } else {
                        $controller = 'utilisateur';
                        $view = 'detail';
                        $pagetitle = 'Accueil';
                        require FILE::build_path(array("view", "view.php"));
                    }
                }
            } else {
                $controller = 'utilisateur';
                $view = 'errormdp';
                $pagetitle = 'Erreur Mot de passe';
                require FILE::build_path(array("view", "view.php"));
            }
        }
    }

    public function validate() {
        $nonce = $_GET['nonce'];
        $login = $_GET['login'];

        $personne = ModelUtilisateur::getUserByLogin($login);
        if ($personne == false) {
            echo 'error';
        } else {
            $nonceOk = $personne->getNonce();
            if ($nonce == $nonceOk) {
                ModelUtilisateur::updateNonce($login);
                self::connect();
            } else {
                echo 'error';
            }
        }
    }

}
