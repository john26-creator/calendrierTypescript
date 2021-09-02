<?php
use PHPUnit\Framework\TestCase;

class ConsultantDAOTest extends TestCase
{
    
    private static $consultantDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Consultant.php");
        ConsultantDAOTest::$consultantDAO = new Consultant;
    }
    
    public static function tearDownAfterClass () : void
    {
        ConsultantDAOTest::$consultantDAO->updateConsultant(1, "jonathan.amselem.pro@gmail.com", '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 'AMSELEM', 'Jonathan');
        ConsultantDAOTest::$consultantDAO->setDMdp (1, 0);
    }
      
    public function testFindByEmail()
    {
        $results = ConsultantDAOTest::$consultantDAO->findByEmail("jonathan.amselem.pro@gmail.com");
        $this->assertTrue(count($results)==1);
    }
    
    public function testFindAll () {
        $results = ConsultantDAOTest::$consultantDAO->findAll ();
        $this->assertTrue(count($results)!=0);
    }
    
    public function testUpdateConsultantNoPassword () {
        ConsultantDAOTest::$consultantDAO->updateConsultantNoPassword(1,"jonathan.amselem.pro@gmail.com2", "nom2", "prenom2");
        $results = ConsultantDAOTest::$consultantDAO->findById (1);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getId(), "1");
        $this->assertSame($results[0]->getNom(), "nom2");
        $this->assertSame($results[0]->getPrenom(), "prenom2");
        $this->assertSame($results[0]->getEmail(), "jonathan.amselem.pro@gmail.com2");
    }
    
    
    public function testCreerConsultant () {
        $idEmployeur = ConsultantDAOTest::$consultantDAO->creerConsultant ("laly@famillebessone.com", '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', "Bessone", "Laly");
        $results = ConsultantDAOTest::$consultantDAO->findByEmail("laly@famillebessone.com");
        $this->assertTrue(count($results)==1);
    }
    
    public function testUpdatePasswordAndDMdp(){
        ConsultantDAOTest::$consultantDAO->updatePasswordAndDMdp(1, "newpassword");
        $consultants = ConsultantDAOTest::$consultantDAO->findById(1);
        $this->assertSame(1,count($consultants));
        $this->assertSame($consultants[0]->getMotDePasse(), "newpassword");
        $this->assertSame($consultants[0]->getDMP(), '1');
    }
    
    public function testsetDMdp(){
        ConsultantDAOTest::$consultantDAO->setDMdp (1, 0);
        $consultants = ConsultantDAOTest::$consultantDAO->findById(1);
        $this->assertSame(1,count($consultants));
        $this->assertSame($consultants[0]->getDMP(), '0');
    }
    
    public function testDeleteEmployeurById (){
        $consultants = ConsultantDAOTest::$consultantDAO->findByEmail("laly@famillebessone.com");
        $this->assertSame(1,count($consultants));
        ConsultantDAOTest::$consultantDAO->deleteConsultantById ($consultants[0]->getId());
        $results = ConsultantDAOTest::$consultantDAO->findById ($consultants[0]->getId());
        $this->assertTrue(count($results)==0);
    }
    
}