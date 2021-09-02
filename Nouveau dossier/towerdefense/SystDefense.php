<?php

class SystDefense {

    private $niveau;
    private $degat;
    private $projectiles;

    function __construct(int $niveau, int $degat, array $projectiles) {
        $this->niveau = $niveau;
        $this->degat = $degat;
        $this->projectiles = $projectiles;
    }

    public function getNiveau ()  {
        return $this->niveau;
    }

    public function setNiveau (int $niveau) {
        $this->niveau = $niveau;
    }

    public function cibler () {
        print_r("cibler !!!");
    }

    public function tirer ($enemi) {
        print_r("tirer !!!");
    }


    public function lvlUp () {
        $this->niveau ++;
        print_r("lvlUp !!! ". $this->niveau);
    }


}


class TourFlamme extends SystDefense {
    private $temperature;

    function __construct($temp)
    {
        parent::__construct(1,190,array( "grenades incendiaires", "napalme"));
        $this->temperature = $temp;
    }


    public function cibler () {
        print_r("cibler Zone!!");
    }

}

class TourMissile extends SystDefense {
    private $nbMissiles;

    function __construct($nbMissiles)
    {
        parent::__construct(1,190,array( "Skud", "SAM", "Mortier"));
        $this->nbMissiles = $nbMissiles;
    }


    public function tirer ($cible) {
        print_r("Fire !!");
    }


}

$sysdef = new SystDefense(0,45, array('rocket' , "mortier", "grenades incendiaires", "napalme"));
// var_dump($sysdef);
// $sysdef->setNiveau(4);
// var_dump($sysdef->getNiveau());

// $sysdef->cibler();
// $sysdef->tirer(3);
// $sysdef->lvlUp();
// $sysdef->lvlUp();

$tourF = new TourFlamme(2000);
//($tourF);
$tourF->lvlUp();
$tourF->cibler();
$tourF->tirer(5);


$tourM = new TourMissile(456);
$tourM->lvlUp();
$tourM->cibler();
$tourM->tirer(5);
?>