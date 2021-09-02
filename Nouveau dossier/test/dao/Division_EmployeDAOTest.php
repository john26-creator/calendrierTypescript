<?php
use PHPUnit\Framework\TestCase;

class Division_EmployeDAOTest extends TestCase
{
    
    private static $division_EmployeDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Division_Employe.php");
        Division_EmployeDAOTest::$division_EmployeDAO = new Division_Employe;
    }
    
    public static function tearDownAfterClass () : void
    {
        Division_EmployeDAOTest::$division_EmployeDAO->addDivision_EmployeCPL(180,193,154);
    }
    
    
    public function testFindById()
    {
        $results = Division_EmployeDAOTest::$division_EmployeDAO->findById(180);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getId_division(), "193");
        $this->assertSame($results[0]->getIdDivision_Employe(), "154");
    }
    
    /**
     * Column idEntreprise Finder
     * @return object[]
     */
    public function testFindByIdEmploye()
    {
        $results = Division_EmployeDAOTest::$division_EmployeDAO->findByIdEmploye(154);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getId(), "180");
    }
    
    public function testAddDivision_Employe () {
        $idDivision_Employe = Division_EmployeDAOTest::$division_EmployeDAO->addDivision_Employe(294,154);
        $results = Division_EmployeDAOTest::$division_EmployeDAO->findById($idDivision_Employe);
        $this->assertTrue(count($results)==1);
    }
    
    public function testDeleteDivisionByEmployeId () {
        Division_EmployeDAOTest::$division_EmployeDAO->deleteDivisionByEmployeId(154);
        $results = Division_EmployeDAOTest::$division_EmployeDAO->findByIdEmploye(154);
        $this->assertTrue(count($results)==0);
    }
}