<?php

require_once File::build_path(array("model", "Model.php"));

class ModelProduit {

    // ATTRIBUTS

    private $modeleImprimante;
    private $Couleur;
    private $Quantite;

    // GETTERS

    public function getImprimante() {
        return $this->modeleImprimante;
    }

    public function getCouleur() {
        return $this->Couleur;
    }

    public function getQuantite() {
        return $this->Quantite;
    }

    // SETTERS

    public function setImprimante($imp2) {
        $this->modeleImprimante = $imp2;
    }

    public function setCouleur($c2) {
        $this->Couleur = $c2;
    }

    public function setQuantite($q2) {
        $this->Quantite = $q2;
    }

    // CONSTRUCTEUR

    public function __construct($imp = NULL, $co = NULL, $q = NULL) {
        if (!is_null($imp) && !is_null($co) && !is_null($q)) {
            $this->modeleImprimante = $imp;
            $this->Couleur = $co;
            $this->Quantite = $q;
        }
    }

    // METHODES

    public function getAllProduits() {
        $sql = "SELECT * FROM produit";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelProduit');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getProduitByModeleCouleur($modele, $couleur) {
        $sql = "SELECT * FROM produit WHERE modeleImprimante =:read1 AND Couleur =:read2";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $modele,
            "read2" => $couleur,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelProduit');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod[0];
    }

    public function deleteByModeleCouleur($m, $c) {
        try {
            $sql = "DELETE FROM produit WHERE modeleImprimante =:read1 AND Couleur =:read2";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $m,
                'read2' => $c,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function incrementeStockProduit($nbStock) {
        if ($this->Quantite + $nbStock >= 0) {
            
            $sql = "UPDATE produit SET Quantite =:read1 WHERE modeleImprimante =:read2 AND Couleur =:read3";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $this->Quantite + $nbStock,
                'read2' => $this->modeleImprimante,
                'read3' => $this->Couleur,
            );
            $req->execute($values);
            return true;
        } else {
            return false;
        }
    }

    public function save() {
        try {
            $sql = "INSERT INTO produit(modeleImprimante ,Couleur ,Quantite) VALUES (:modele, :couleur, :quantite)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'modele' => $this->modeleImprimante,
                'couleur' => $this->Couleur,
                'quantite' => $this->Quantite,
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function deleteProduitsByImprimante($m){
        $sql = "DELETE FROM produit WHERE modeleImprimante =:read1 ";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            'read1' => $m,
            );
        $req->execute($values);
        
    }

}
