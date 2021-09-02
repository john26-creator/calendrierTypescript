<?php

class Fournisseur extends Personne
{

    private string $codeComptable;
    private array $produitQuantite;

    function __construct(string $codeComptable)
    {
        $this->codeComptable = $codeComptable;
        //$this->produitQuantite = array(new Produit () => 5);
    }

    public function modifierInfos($array): void
    {
    }
}
