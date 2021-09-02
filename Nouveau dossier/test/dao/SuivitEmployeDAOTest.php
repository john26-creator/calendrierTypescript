<?php 
use PHPUnit\Framework\TestCase;

class SuivitEmployeDAOTest extends TestCase
{
    
    private static $suivitEmployeDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/SuivitEmploye.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
        SuivitEmployeDAOTest::$suivitEmployeDAO = new SuivitEmploye;
    }
    
    public static function tearDownAfterClass () : void
    {
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 4, 1, 5, 4, 8, 1, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 8, 7, 8, 8, 4, 2, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 3, 8, 5, 9, 1, 3, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 7, 8, 8, 4, 4, 4, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 7, 8, 8, 4, 4, 5, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 9, 4, 0, 6, 4, 6, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 8, 9, 4, 4, 9, 7, 13);
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 9, 7, 5, 9, 1, 8, 13);
    }
    
    
    public function testGetSuivitsEmployesByEntrepriseIdWeekAndDivision () {
        $ids_employe = array(new Employe (141),new Employe (142),new Employe (144),new Employe (145),new Employe (146),new Employe (147),new Employe (148),new Employe (149),new Employe (150));
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdWeekAndDivision (13,1,$ids_employe);
    	$this->assertSame(9, count($results));
    }
    
    public function testGetSuivitsEmployesByEntrepriseIdAndWeek() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdAndWeek(13, 1);
        $this->assertSame(13, count($results));
    }
    
    public function testGetSuivitsEmployesByEmployeIdAndWeek() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitsEmployesByEmployeIdAndWeek(142, 1);
        $this->assertSame(1, count($results));
    }
    
    public function testGetSuivitEmployeByidEmployeAndWeekAndEntrepriseId() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitEmployeByidEmployeAndWeekAndEntrepriseId(142,1,13);
        $this->assertSame(1, count($results));
    }
    
    public function testGetSuivitEmployeByIdEmploye() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitEmployeByIdEmploye(140);
        $this->assertSame(8, count($results));
    }
    
    public function testGetSemainesSuivitsEmployesByEntrepriseId() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSemainesSuivitsEmployesByEntrepriseId(13);
        $this->assertSame(8, count($results));
    }
    
    public function testGetSuivitsEmployesByEmployeIdAndEntrepriseIdByWeek() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitsEmployesByEmployeIdAndEntrepriseIdByWeek(141,13);
        $this->assertSame(8, count($results));
    }
    
    public function testAddSuivitEmploye() {
        SuivitEmployeDAOTest::$suivitEmployeDAO->addSuivitEmploye(140, 1, 2, 3, 4, 5, 9, 13);
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitEmployeByidEmployeAndWeekAndEntrepriseId(140,9,13);
        $this->assertSame(1, count($results));
    }
    
    public function testUpdateSuivitEmploye() {
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->updateSuivitEmploye(1, 2, 3, 4, 5,140,1,13);
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitEmployeByidEmployeAndWeekAndEntrepriseId(140,1,13);
        $this->assertSame(1, count($results));
        $this->assertSame("1", $results[0]->getSommeil());
        $this->assertSame("2", $results[0]->getStress());
        $this->assertSame("3", $results[0]->getAnxiete());
        $this->assertSame("4", $results[0]->getEnergie());
        $this->assertSame("5", $results[0]->getDigestion());
    }
    
    
    public function testDeleteSuivitEmploye() {
        SuivitEmployeDAOTest::$suivitEmployeDAO->deleteSuivitEmploye(140, 13);
        $results = SuivitEmployeDAOTest::$suivitEmployeDAO->getSuivitsEmployesByEmployeIdAndEntrepriseIdByWeek(140,13);
        $this->assertSame(0, count($results));
    }
    
   
}