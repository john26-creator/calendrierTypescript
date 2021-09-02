<?php
use PHPUnit\Framework\TestCase;

class EmployeDAOTest extends TestCase
{
    
    private $employeDAO; 
    static $id_employe;
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
    }
    
    public static function tearDownAfterClass () : void {
        $employeDAO = new Employe;
        $employeDAO->addEmployeCPL (140, "email1@test.fr", '$2y$10$qonRBDbjuoHp20zcJEF8sO66geankAfgN5SICdfDDfli4Ue8.jvkS', 13);
        $employeDAO->deleteEmploye(EmployeDAOTest::$id_employe,13);
    }
    
    public function setUp(): void {
        $this->employeDAO = new Employe;
    }
    
    public function testFindById () {
        $employes = $this->employeDAO->findById (142);
        $this->assertSame(1,count($employes));
    }
    
    
    public function testFindEmployesFromDivision () {
        $ids_employe = $this->employeDAO->findEmployesFromDivision(185);
        $this->assertSame(5, count($ids_employe));
    }
    
    public function testFindDivisionChildren () {
        $divisionIds = array();
        $this->employeDAO->findDivisionChildren ($divisionIds,184);
        $divisionIds = array_unique (array_filter($divisionIds));
        $this->assertTrue(count($divisionIds)==6);
    }
    
    public function testGetChildrenFromDivision () {
        $children = $this->employeDAO->getChildrenFromDivision(184);
        $this->assertTrue(count($children)==2);
        $this->assertTrue($children[0]->getId()==185 || $children[0]->getId()==186);
        $this->assertTrue($children[1]->getId()==185 || $children[1]->getId()==186);
    }
    
    public function testFindByEmail () {
        $employes = $this->employeDAO->findByEmail ("email1@test.fr");
        $this->assertSame(1,count($employes));
    }
    
    public function testGetEmployesByIdEntreprise () {
        $employes = $this->employeDAO->getEmployesByIdEntreprise (13);
        $this->assertSame(13,count($employes));
    }
     
    public function testUpdateEmployeIdentifiers () {
        $this->employeDAO->updateEmployeIdentifiers (140,"email1Modifie@test.fr", "passwordModifie");
        $employes = $this->employeDAO->findByEmail ("email1Modifie@test.fr");
        $this->assertSame(1,count($employes));
        $this->assertSame($employes[0]->getEmail(), "email1Modifie@test.fr");
        $this->assertSame($employes[0]->getMotDePasse(), "passwordModifie");
    }
    
    public function testUpdatePasswordAndDMdp(){
        $this->employeDAO->updatePasswordAndDMdp(140, "newpassword");
        $employes = $this->employeDAO->findById(140);
        $this->assertSame(1,count($employes));
        $this->assertSame($employes[0]->getMotDePasse(), "newpassword");
        $this->assertSame($employes[0]->getDMP(), '1');
    }
    
    public function testsetDMdp(){
        $this->employeDAO->setDMdp (140, 0);
        $employes = $this->employeDAO->findById(140);
        $this->assertSame(1,count($employes));
        $this->assertSame($employes[0]->getDMP(), '0');
    }
    
    
    public function testDeleteEmploye () {
        $this->employeDAO->deleteEmploye(140,13);
        $employes = $this->employeDAO->findById(140);
        $this->assertSame(0,count($employes));
    }
    
   
    
    public function testAddEmploye () {
        EmployeDAOTest::$id_employe = $this->employeDAO->addEmploye ("email16@test.fr", "mdp6", 13);
        $employes = $this->employeDAO->findById(EmployeDAOTest::$id_employe);
        $this->assertSame(1,count($employes));
    }
    
    
}