<?php

class Employe
{

    //attributs (instance courante cad un employé)
    //pour y faire appel vous devez appeler $this
    private string $nom;
    private int $age;
    private float $salaire;
    private string $nosecu;
    const BRUT_PERCENTAGE = 0.8; //static

    //sert a creer une instance de classe (cas un employé)
    //on l'utlise en faisant (Ex: new Employe ("albert", 35, 50000, "1XXXXXXXXXXXXX"))
    function __construct(string $nom, int $age, float $salaire, string $nosecu)
    {
        $this->nom = $nom;
        $this->age = $age;
        $this->salaire = $salaire;
        $this->nosecu = $nosecu;
        echo "constructeur Employe \n";
    }

    //Getters/Setters
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public  function  getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getSalaire(): float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): void
    {
        $this->salaire = $salaire;
    }

    public function getNosecu(): string
    {
        return $this->nosecu;
    }

    public function setNosecu(string $nosecu): void
    {
        $this->nosecu = $nosecu;
    }

    //Methodes
    /**
     * @param float $percent pourcentage d'augmentation du salaire
     * @return void
     */
    public function augmentation($percent): void
    {
        $this->salaire *= (1 + $percent);
    }

    public function toString(): string
    {
        return "[nom: " . $this->nom . ", age: " . $this->age . ", salaire: " . $this->salaire . ", nosecu: " . $this->nosecu . "]\n";
    }

    public function afficher()
    {
        echo $this->toString();
    }

    public function calculeSalaire()
    {
        return $this->salaire * Employe::BRUT_PERCENTAGE; //self::BRUT_PERCENTAGE fonctionne aussi
    }
}