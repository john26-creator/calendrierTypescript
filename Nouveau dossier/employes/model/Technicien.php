<?php
class Technicien extends Employe
{
    private string $grade; //a,b,c

    function __construct(string $nom, int $age, float $salaire, string $nosecu, string $grade)
    {
        parent::__construct($nom, $age, $salaire, $nosecu);
        $this->grade = $grade;
        echo "constructeur Technicien \n";
    }

    public function  prime(): int
    {
        switch ($this->grade) {
            case "a":
                return 100;
                break;
            case "b":
                return 200;
                break;
            case "c":
                return 300;
                break;
            default:
                0;
        }
    }
    public function toString(): string
    {
        return "[nom: " . parent::getNom() . ", age: " . $this->getAge() . ", salaire: " . $this->getSalaire() . ", nosecu: " . $this->getNosecu() .  ", grade: " . $this->grade . "]\n";
    }

    public function calculeSalaire() :float
    {
        return parent::calculeSalaire() + $this->prime();
    }

    //Static !!! ne fais pas appel à l'insatance courante ($this)
    public static function compare(Technicien $t1, Technicien $t2): bool
    {
        return ($t1->getAge() > $t2->getAge());
    }
}
