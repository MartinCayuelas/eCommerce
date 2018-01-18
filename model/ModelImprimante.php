<?php

require_once File::build_path(array("model", "Model.php"));

class ModelImprimante {

    private $modeleImprimante;
    private $prix;
    private $dimension;
    private $poids;
    private $gamme;

    public function getModele() {
        return $this->modeleImprimante;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getDimension() {
        return $this->dimension;
    }

    public function getPoids() {
        return $this->poids;
    }

    public function getGamme() {
        return $this->gamme;
    }

// SETTERS

    public function setModele($id2) {
        $this->modeleImprimante = $id2;
    }

    public function setPrix($prix2) {
        $this->prix = $prix2;
    }

    public function setDimension($taille2) {
        $this->dimension = $taille2;
    }

    public function setPoids($poids2) {
        $this->poids = $poids2;
    }

    public function setGamme($gamme2) {
        $this->gamme = $gamme2;
    }

    public function __construct($id2 = NULL, $pr = NULL, $ta = NULL, $po = NULL, $ga = NULL) {
        if (!is_null($id2) && !is_null($pr) && !is_null($ta) && !is_null($po) && !is_null($ga)) {
            $this->modeleImprimante = $id2;
            $this->prix = $pr;
            $this->dimension = $ta;
            $this->poids = $po;
            $this->gamme = $ga;
        }
    }

    /*
      public function __construct($id2, $pr, $ta, $po, $ga, $co) {
      $this->modeleImprimante= $id2;
      $this->prix = $pr;
      $this->taille = $ta;
      $this->poids = $po;
      $this->gamme = $ga;
      $this->couleur = $co;
      } */

    public static function getAllImprimantes() {
        $sql = "SELECT * from imprimante";
        $rep = Model::$pdo->query($sql);
        $tab_imp = $rep->FetchAll(PDO::FETCH_CLASS, 'ModelImprimante');
        if (empty($tab_imp)) {
            return false;
        }
        return $tab_imp;
    }

    public static function getImprimanteById($id) {
        $sql = "SELECT * from imprimante WHERE modeleImprimante = :nom_tag";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "nom_tag" => $id,
        );

        $req_prep->execute($values);

        $tab_imp = $req_prep->FETCHALL(PDO::FETCH_CLASS, 'ModelImprimante');


        if (empty($tab_imp)) {
            return false;
        }
        return $tab_imp[0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO imprimante(modeleImprimante, prix, dimension, poids,gamme) VALUES (:id, :prix, :dimension, :poids, :gamme)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                "id" => $this->modeleImprimante,
                "prix" => $this->prix,
                "dimension" => $this->dimension,
                "poids" => $this->poids,
                "gamme" => $this->gamme,
            );
            return $req->execute($values);
//$req->FETCHALL(PDO::FETCH_CLASS, 'ModelProduit');
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByModel() {
        $sql = "DELETE FROM imprimante WHERE modeleImprimante = :model";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "model" => $this->modeleImprimante,
        );
        $req_prep->execute($values);
    }

}
