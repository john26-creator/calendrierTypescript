<?php
use PHPUnit\Framework\TestCase;

class AdminDAOTest extends TestCase
{
    
    private static $adminDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Admin.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Utils.php");
        AdminDAOTest::$adminDAO = new Admin;
    }
    
    public function testById () {
        $results = AdminDAOTest::$adminDAO->findById (1);
        $this->assertTrue(count($results)==1);
    }
    
    public function testFindByEmail () {
        $results = AdminDAOTest::$adminDAO->findByEmail (md5("jonathan.amselem.pro@gmail.com"));
        $this->assertTrue(count($results)==1);
    }
    
    public function testUpdatePassword () {
        AdminDAOTest::$adminDAO->updateAdminIdentifiers (md5("jonathan.amselem.pro@gmail.com"),"test");
        $results = AdminDAOTest::$adminDAO->findById (1);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getMotDePasse(),"test");
    }
    
    public function testUpdatePasswordAndDMP () {
        AdminDAOTest::$adminDAO->updatePasswordAndDMdp (1,'$2y$10$RRNDIn6KgDvrulEKc5tefOEozKpkn/ZF5Sxvr0BaemomjZpjW.J22');
        $results = AdminDAOTest::$adminDAO->findById (1);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getMotDePasse(),'$2y$10$RRNDIn6KgDvrulEKc5tefOEozKpkn/ZF5Sxvr0BaemomjZpjW.J22');
        $this->assertSame($results[0]->getDMP(),"1");
    }
    
    public function testUpdateDMP () {
        AdminDAOTest::$adminDAO->setDMdp (1,0);
        $results = AdminDAOTest::$adminDAO->findById (1);
        $this->assertTrue(count($results)==1);
        $this->assertSame($results[0]->getDMP(),"0");
    }
}
    