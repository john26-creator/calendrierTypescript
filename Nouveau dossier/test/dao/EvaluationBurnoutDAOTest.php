<?php
use PHPUnit\Framework\TestCase;

class EvaluationBurnoutDAOTest extends TestCase
{
    
    private static $evaluationBurnoutDAO;  
    
    public static function setUpBeforeClass() : void
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
        EvaluationBurnoutDAOTest::$evaluationBurnoutDAO = new Evaluationburnout;
    }
    
    public static function tearDownAfterClass () : void
    {
       EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(133,5,4,0,0,0,6,3,7,0,7,0,2,0,0,2,0,2,0,2,0,1,6,0,13,154);
    }

    public function testGetEvaluationBurnoutById () {
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->getEvaluationBurnoutById (142, 0);
        $this->assertTrue(count($results)==1);
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->getEvaluationBurnoutById (142, 1);
        $this->assertTrue(count($results)==0);
    }
    
    public function testFindByIdEntrepriseAndSemaine()
    {
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->findByIdEntrepriseAndSemaine(13, 0);
        $this->assertEquals(count($results),15);
    }
    
    public function testGetEvaluationFromEmployesGroup () {
        $ids_employe = array(new Employe(150),new Employe(151),new Employe(152),new Employe(154));
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->getEvaluationFromEmployesGroup (13, 0, $ids_employe);
        $this->assertEquals(count($results),4);
    }
    
    public function testInsertEvaluationBurnout()
    {
        EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->insertEvaluationBurnout(1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 1, 13, 154);
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->findByIdEntrepriseAndSemaine(13, 1);
        $this->assertEquals(count($results),1);
    }
    
    public function testDeleteEvaluationBurnout ()
    {
        EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->deleteEvaluationBurnout (154, 13);
        $results = EvaluationBurnoutDAOTest::$evaluationBurnoutDAO->findByIdEntrepriseAndSemaine(13, 0);
        $this->assertEquals(count($results),14);
    }
}
    