<?php
use PHPUnit\Framework\TestCase;

class DivisionDAOTest extends TestCase
{
    
    private static $divisionDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Division.php");
        DivisionDAOTest::$divisionDAO = new Division;
    }
    
    public static function tearDownAfterClass () : void
    {
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (184, "departement1", NULL, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (185,  "service1", 184, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (186, "service2", 184, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (188, "equipe1", 185, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (189, "equipe2", 185, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (190, "equipe3", 186, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (191, "departement2", NULL, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (192, "service3", 191, 13);
        DivisionDAOTest::$divisionDAO->addDivisionAllFields (193, "equipe4", 192, 13);
    }
    

    public function testFindBynom()
    {
        $result = DivisionDAOTest::$divisionDAO->findBynom("departement1"); //1 resultat
        $this->assertTrue(isset($result));
        $this->assertSame($result->getId(), "184");
    }
    

    public function testFindChildrenById()
    {
        $results = DivisionDAOTest::$divisionDAO->findChildrenById(184);//1 resultat
        $this->assertTrue(count($results)==2);
        //$this->assertSame($results[0]->getId(), "184");
    }
    
    public function testAddDivision () {
        $idDivision = DivisionDAOTest::$divisionDAO->addDivision ("addDivision", 2000, 13);
        $results = DivisionDAOTest::$divisionDAO->findById($idDivision);
        $this->assertTrue(count($results)==1);
    }
    
    public function testAddDivision2 () {
        $idDivision = DivisionDAOTest::$divisionDAO->addDivision2 ("addDivision2",13);
        $results = DivisionDAOTest::$divisionDAO->findById($idDivision);
        $this->assertTrue(count($results)==1);
    }
    
    public function testDeleteDivisionByEmployeurId () {
        DivisionDAOTest::$divisionDAO->deleteDivisionByEmployeurId(13);
        $results = DivisionDAOTest::$divisionDAO->findAll(13);//1 resultat
        $this->assertTrue(count($results)==0);
    }
}
    