<?php
/**
 * 
 */
class Client extends Personne
{

    // Attributs
    protected $dateCrea;
    protected $mdp;
    private Commande $commande;

    // Constructeur
    function __construct(string $nom, string $prenom, string $mail, string $adresse, int $cp, string $ville, string $dateNaissance, int $id, string $dateCrea, string $mdp)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->dateNaissance = $dateNaissance;
        $this->id = $id;
        $this->dateCrea = $dateCrea;
        $this->mdp = $mdp;
    }

    // Getter et Setter
    public function getDateInscription() :DateTime
    {
        return new DateTime();
        # code...
    }


    public function read() :array
    {
        return [];
        # code...
    }

    public function update(array $modif) :bool
    {
        # code...
        return true;
    }

    public function delete() :bool
    {
        # code...
        return true;
    }

    public function authentification() :bool
    {
        # code...
        return true;
    }

    public function modifierInfos ($array) :void {

    }

    public function getCommande () : Commande {
        return $this->commande;
    }

    public function setCommande (Commande $commande) :void {
        $this->commande = $commande;
    }
}
