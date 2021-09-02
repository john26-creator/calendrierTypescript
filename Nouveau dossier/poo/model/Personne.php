<?php


abstract class Personne {

    //attribut de classe
    protected string $nom;
    protected string $prenom;
    protected string $mail;
    protected string $adresse;
    protected int $cp;
    protected string $ville;
    protected string $dateNaissance;
    protected int $id;

    // function __construct($nom, string $prenom, string $mail,
    //  string $adresse, int $cp, string $ville,
    //  string $dateNaissance, int $id)
    // {
        
    // }

    public function setNom($nom) : void
    {
        $this->nom = $nom;
    }

    public function getNom() : string
    {
        return $this->nom;
    }

    public function setPrenom($prenom) :void
    {
        $this->prenom = $prenom;
    }

    public function getPrenom() :string
    {
        return $this->prenom;
    }

    public function setMail($mail) : void
    {
        $this->mail = $mail;
    }

    public function getMail() : string
    {
        return $this->mail;
    }

    public abstract function modifierInfos ($array) :void;
}