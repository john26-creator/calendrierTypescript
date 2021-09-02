<?php

class Commande
{
    private $numCommande;
    private $dateCommande;
    private $dateLivraison;
    private $panier;

    function __construct(int $numCommande, string $dateCommande, string $dateLivraison, Panier $panier)
    {
        $this->numCommande = $numCommande;
        $this->dateCommande = $dateCommande;
        $this->dateLivraison = $dateLivraison;
        $this->panier = $panier;
    }

}
