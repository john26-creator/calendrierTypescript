<?php
use PHPUnit\Framework\TestCase;

class EmployeurDAOTest extends TestCase
{
    
    private static $employeurDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
        EmployeurDAOTest::$employeurDAO = new Employeur;
    }
    
    public static function tearDownAfterClass () : void
    {
        EmployeurDAOTest::$employeurDAO->creerEmployeurCPL(13, "eurogiciel", "dirigeant", "siret", "ape", "adresse", md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2');
    }
    
    public function testFindByNomEntreprise () {
        $results = EmployeurDAOTest::$employeurDAO->findByNomEntreprise ("eurogiciel");
        $this->assertTrue(count($results)==1);
    }
    
    public function testGetEmployeurById () {
        $results = EmployeurDAOTest::$employeurDAO->getEmployeurById (13);
        $this->assertTrue(count($results)==1);
    }
    
    public function testFindByEmail()
    {
        $results = EmployeurDAOTest::$employeurDAO->findByEmail(md5("amselem.jonathan@gmail.com"));
        $this->assertTrue(count($results)==1);
    }
    
    public function testFindAll () {
        $results = EmployeurDAOTest::$employeurDAO->findAll ();
        $this->assertTrue(count($results)!=0);
    }
    
    public function testUpdateEmployeurNoPassword () {
        EmployeurDAOTest::$employeurDAO->updateEmployeurNoPassword("eurogiciel2", "dirigeant2", "siret2", "ape2", 1, 2, "email2", 13);
        $results = EmployeurDAOTest::$employeurDAO->getEmployeurById (13);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getId(), "13");
        $this->assertSame($results[0]->getNomEntreprise(), "eurogiciel2");
        $this->assertSame($results[0]->getDirigeant(), "dirigeant2");
        $this->assertSame($results[0]->getSiret(), "siret2");
        $this->assertSame($results[0]->getAPE(), "ape2");
        $this->assertSame($results[0]->getEmail(), "email2");
        $this->assertSame($results[0]->getSemaine(), "2");
        $this->assertSame($results[0]->getBilan(), "1");
    }
    
    
    public function testUpdateEmployeur () {
        EmployeurDAOTest::$employeurDAO->updateEmployeur ("test", "test", "test", "test", 1, 4, "test", "test", 13);
        $results = EmployeurDAOTest::$employeurDAO->getEmployeurById(13);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getId(), "13");
        $this->assertSame($results[0]->getNomEntreprise(), "test");
        $this->assertSame($results[0]->getDirigeant(), "test");
        $this->assertSame($results[0]->getSiret(), "test");
        $this->assertSame($results[0]->getAPE(), "test");
        $this->assertSame($results[0]->getEmail(), "test");
        $this->assertSame($results[0]->getMotDePasse(), "test");
    }

    
    public function testCreerEmployeur () {
        $idEmployeur = EmployeurDAOTest::$employeurDAO->creerEmployeur ("test", "test", "test", "test", "test", "test", "test");
        $results = EmployeurDAOTest::$employeurDAO->findByEmailAndPassword("test", "test");
        $this->assertTrue(count($results)==1);
    }
    
    public function testUpdatePasswordAndDMdp(){
        EmployeurDAOTest::$employeurDAO->updatePasswordAndDMdp(13, "newpassword");
        $employeurs = EmployeurDAOTest::$employeurDAO->findById(13);
        $this->assertSame(1,count($employeurs));
        $this->assertSame($employeurs[0]->getMotDePasse(), "newpassword");
        $this->assertSame($employeurs[0]->getDMP(), '1');
    }
    
    public function testsetDMdp(){
        EmployeurDAOTest::$employeurDAO->setDMdp (13, 0);
        $employeurs = EmployeurDAOTest::$employeurDAO->findById(13);
        $this->assertSame(1,count($employeurs));
        $this->assertSame($employeurs[0]->getDMP(), '0');
    }
    
    public function testDeleteEmployeurById (){
        EmployeurDAOTest::$employeurDAO->deleteEmployeurById (13);
        $results = EmployeurDAOTest::$employeurDAO->getEmployeurById (13);
        $this->assertTrue(count($results)==0);
    }
    
}