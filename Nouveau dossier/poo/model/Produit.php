<?php

class Produit {
    public int $id;
    public string $nom;
    public string $description;
    public string $image;
    public float $prix;
    public int $quantite;
    private array $fournisseurs;

    function __construct() 
    {
        $this->fournisseurs = array( ); //new Fournisseur("SDFSGHFDGF"), new Fournisseur("#SDF89RT") ...
    }

    public function getFournisseurs () :array { //produit->getFournisseurs()->add (new Fournisseur ("SDFDSF"))
        return $this->fournisseurs;
    }
}