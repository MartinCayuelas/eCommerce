<?php

require_once File::build_path(array("lib", "Security.php"));

class ModelUtilisateur {

    //Attributs
    private $login;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $admin;
    private $nonce;

    public function getLogin() {
        return $this->login;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getprenom() {
        return $this->prenom;
    }

    public function getmail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getNonce() {
        return $this->nonce;
    }

    //Constructeurs

    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $mdp = NULL, $admin = NULL, $nonce = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($mdp) && !is_null($admin) && !is_null($nonce)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->password = $mdp;
            $this->admin = $admin;
            $this->nonce = $nonce;
        }
    }

    public function getAllUtilisateurs() {
        $sql = "SELECT * FROM utilisateur";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getUserByLogin($login) {
        $sql = "SELECT * FROM utilisateur WHERE login =:read";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read" => $login,
        );
        $req->execute($values);
        $tab_prod = $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod[0];
    }

    public function deleteByLogin() {
        $sql = "DELETE FROM utilisateur WHERE login = :login";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "login" => $this->login,
        );
        $req_prep->execute($values);
    }

    public function save() {
        try {
            $sql = "INSERT INTO utilisateur(login, nom, prenom, mail, password, admin, nonce) VALUES (:login, :nom, :prenom, :mail, :password, :admin, :nonce)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                "login" => $this->login,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "mail" => $this->mail,
                "password" => $this->password,
                "admin" => $this->admin,
                "nonce" => $this->nonce,
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkPassword($login, $mot_de_passe_chiffre) {

        $sql = "SELECT* FROM utilisateur WHERE  login= :login AND password= :password";
        $req1 = Model::$pdo->prepare($sql);
        $values1 = array(
            "login" => $login,
            "password" => $mot_de_passe_chiffre,
        );
        $req1->execute($values1);
        $tab = $req1->FetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');
        if (empty($tab)) {
            return false;
        } else {
            return $tab[0];
        }
    }

    public function getAdmin2($login) {
        $uti = ModelUtilisateur::getUserByLogin($login);
        return $uti->getAdmin();
    }

    public function getNonce2($login) {
        $uti = ModelUtilisateur::getUserByLogin($login);
        return $uti->getNonce();
    }

    public function updated($login) {
        $sql = "UPDATE utilisateur SET login =:read1, nom =:read2, prenom =:read3, mail=:read4, password=:read5, admin= :read7 WHERE login=:read6";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $this->login,
            "read2" => $this->nom,
            "read3" => $this->prenom,
            "read4" => $this->mail,
            "read5" => $this->password,
            "read6" => $login,
            "read7"=>  $this->admin,
        );
        return $req->execute($values);
    }
    
    public function updateNonce($login){
        $sql = "UPDATE utilisateur SET nonce =:nonce WHERE login = :login";
        $req = Model::$pdo->prepare($sql);
        $value = array(
            "nonce" => NULL,
            "login" => $login,
        );
        return $req->execute($value);
        
    }
}
