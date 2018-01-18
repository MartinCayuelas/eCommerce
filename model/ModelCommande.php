<?php

require_once File::build_path(array("model", "Model.php"));

class ModelCommande {

    // ATTRIBUTS
    private $idCommande;
    private $modeleImprimante;
    private $couleur;
    private $quantite;
    private $prix;
    private $login;
    private $date;

    function getDate() {
        return $this->date;
    }

    function getCouleur() {
        return $this->couleur;
    }

    function getLogin() {
        return $this->login;
    }

    function getModeleImprimante() {
        return $this->modeleImprimante;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getPrix() {
        return $this->prix;
    }

    function getIdCommande() {
        return $this->idCommande;
    }

    function setModeleImprimante($modeleImprimante) {
        $this->modeleImprimante = $modeleImprimante;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setCouleur($couleur) {
        $this->couleur = $couleur;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function __construct($modeleImprimante = NULL, $couleur = NULL, $quantite = NULL, $prix = NULL, $login = NULL, $date = NULL, $idCommande = NULL) {
        if (!is_null($idCommande) && !is_null($modeleImprimante) && !is_null($couleur) && !is_null($prix) && !is_null($login) && !is_null($quantite) && !is_null($date)) {
            $this->idCommande = $idCommande;
            $this->modeleImprimante = $modeleImprimante;
            $this->couleur = $couleur;
            $this->quantite = $quantite;
            $this->prix = $prix;
            $this->login = $login;
            $this->date = $date;
        }
    }

    public static function getAllCommandesByUser($login) {
        $sql = "SELECT * FROM commande WHERE login =:read";
        $rep = Model::$pdo->prepare($sql);
        $values = array(
            "read" => $login,
        );
        $rep->execute($values);
        $tab_com = $rep->FetchAll(PDO::FETCH_CLASS, 'ModelCommande');

        if (empty($tab_com)) {
            return false;
        }
        return $tab_com;
    }

    public function getCommandesById($id) {
        $sql = "SELECT * FROM commande WHERE idCommande =:read";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read" => $id,
        );
        $req->execute($values);
        $tab_prod = $req->fetchAll(PDO::FETCH_CLASS, 'ModelCommande');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod[0];
    }

    public function commander($login) {

        try {
            
            $sql = "INSERT INTO commande (idCommande, modeleImprimante, couleur, quantite, prix, login, date) VALUES (:id, :modele, :couleur, :quantite, :prix, :login, :date)";

            $req = Model::$pdo->prepare($sql);
            $values = array(
                "id" => $this->idCommande,
                "modele" => $this->modeleImprimante,
                "couleur" => $this->couleur,
                "prix" => $this->prix,
                "quantite" => $this->quantite,
                "login" => $this->login,
                "date" => $this->date,
            );

            $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

}
