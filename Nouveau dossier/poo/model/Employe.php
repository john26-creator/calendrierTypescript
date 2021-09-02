<?php

use Employe as GlobalEmploye;

class Employe extends Personne {

    private $noSecu;
    private $salaire;
    private $superieur;
    private $fonction = "Employé";


    function __construct($nom, string $prenom, string $mail,
        string $adresse, int $cp, string $ville,
        string $dateNaissance, int $id, string $noSecu, float $salaire, Employe $superieur)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->adresse = $adresse;
            $this->cp = $cp;
            $this->ville = $ville;
            $this->dateNaissance = $dateNaissance;
            $this->id = $id;
            $this->noSecu = $noSecu;
            $this->salaire = $salaire;
            $this->superieur = $superieur;
            
        }

    public function promotion () {
        $this->superieur = $this->superieur->getSuperieur();
    }

    public function delete () {
        echo "suppession Employé " . $this->nom;
    }

    public function read () {
        echo "Employé " . $this->nom . " " . $this->prenom;
    }

    public function modifierInfos ($array) :void {

    }

    public function getSuperieur () : Employe {
        return $this->superieur;
    }
}