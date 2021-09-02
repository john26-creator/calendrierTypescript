<?php

class Panier {

    private int $noPanier;
    private array $produits;


    function __construct(int $noPanier)
    {
        $this->noPanier = $noPanier;
        $this->produits =  array();
    }

}