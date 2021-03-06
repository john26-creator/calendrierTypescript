<?php
use PHPUnit\Framework\TestCase;

class TestVoitureDao extends TestCase {

    private static $voitureDao;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Voiture.php");
        TestVoitureDao::$voitureDao = new Voiture();
    }

    public static function tearDownAfterClass () : void
    {
        $voiture = TestVoitureDao::$voitureDao->findById (4);
        $voiture->setCouleur ("champagne");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        TestVoitureDao::$voitureDao->insertVoiture2(53, "Blanc", "Citroen", "AX", "TR-654-WL");
    }


    public function testFindAll () {
        $voitures = TestVoitureDao::$voitureDao->findAll();
        $this->assertEquals(count($voitures),3);
    }

    public function testfindById () {
        $voiture = TestVoitureDao::$voitureDao->findById (4);
        $this->assertNotNull($voiture);
    }

    public function testUpdateVoiture () {
        $voiture = TestVoitureDao::$voitureDao->findById (4);
        $voiture->setCouleur ("rouge");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        $voitureUpdated = TestVoitureDao::$voitureDao->findById (4);
        $this->assertEquals($voitureUpdated->getCouleur(),"rouge");
    }

    public function testDeleteVoiture () {
        $isDeleted = TestVoitureDao::$voitureDao->deleteVoiture (53);
        $this->assertTrue ($isDeleted);
    }

}