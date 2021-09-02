<?php
use PHPUnit\Framework\TestCase;

/**
 * Class Employeur
 */
class EmployeurControllerTest extends TestCase
{
    private static $employeurController;
    private static $evaluationBurnoutDAO; 
    private static $employeurDAO;
	
	public static function setUpBeforeClass() : void
	{
	    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeurController.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
	    EmployeurControllerTest::$employeurController = new EmployeurController;
	    EmployeurControllerTest::$evaluationBurnoutDAO = new Evaluationburnout;
	    EmployeurControllerTest::$employeurDAO = new Employeur;
	}

		public function testConnexion () {
		EmployeurControllerTest::$employeurDAO->resetLastTentativeAndlastConnexion("13");
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "o3y.hP2/";
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::success);
	    $this->assertSame($_SESSION[ID::idEmployeur],"13");
	    
	    $_POST['login'] = "wrongUser@mail.fr";
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	}
	
	public function testFiveMinutesBlockConnexion () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "o3y.hP2/8";
	    $_SESSION[ID::idEmployeur] = 13;
	    EmployeurControllerTest::$employeurController->lastConnexion();
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	    
	    $_POST['motdepasse'] = "o3y.hP2/";
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	}
	
	public function testConnexionAfterFiveMinuteblock () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "o3y.hP2/";
	    EmployeurControllerTest::$employeurController->lastConnexion();
	    EmployeurControllerTest::$employeurDAO->setLastTentative5minutesAgo("13");
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::success);
	    
	    $employe = EmployeurControllerTest::$employeurDAO->findById("13")[0];
	    $this->assertSame($employe->getNbTentatives(), "0");
	}
	
	public function test1DayBlockConnexion () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "o3y.hP2/8";
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	    
	    EmployeurControllerTest::$employeurDAO->setLastTentative5minutesAgo("13");
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failDay);
	    
	    $_POST['motdepasse'] = "o3y.hP2/";
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failDay);
	    
	    EmployeurControllerTest::$employeurDAO->setLastTentative1Day("13");
	    $result = EmployeurControllerTest::$employeurController->connexion();
	    $this->assertSame($result, STATUS::success);
	}
	
	/**
	 * retourne un tableau associatif ("DBI" => $DBI, "DBF" => $DBF)
	 * DBI = Display Bilan Initial
	 * DBF = Display Bilan Final
	 */
	public function testGetDisplayBarVariables () {
	    $_SESSION['entreprise'] = 13;
	    $result = EmployeurControllerTest::$employeurController->getDisplayBarVariables();
	    //array("DBI" => true, "DBF" => false);
	    $this->assertTrue($result["DBI"]);
	    $this->assertFalse($result["DBF"]);
	    //Ajouter les evaluations de la seconde semaine
	    //set le bilan de l'entreprise à 1
	    $this->addSuivit(1);
	    EmployeurControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 1, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$qVK5Hd7JUv3HNJZWdw7StOQtOf8fmZ.MR3OUjxiZdWYwBib.DubxO', 13);
	    $result = EmployeurControllerTest::$employeurController->getDisplayBarVariables();
	    //array("DBI" => true, "DBF" => true);
	    $this->assertTrue($result["DBI"]);
	    $this->assertTrue($result["DBF"]);
	    //supprimer les evaluations burnout
	    //set le bilan de l'entreprise à 0
	    EmployeurControllerTest::$evaluationBurnoutDAO->deleteEvaluationBurnoutByEntreprise (13);
	    EmployeurControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 0, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$qVK5Hd7JUv3HNJZWdw7StOQtOf8fmZ.MR3OUjxiZdWYwBib.DubxO', 13);
	    $result = EmployeurControllerTest::$employeurController->getDisplayBarVariables();
	    //array("DBI" => false, "DBF" => false);
	    $this->assertFalse($result["DBI"]);
	    $this->assertFalse($result["DBF"]);
	    //tearDown
	    $this->addSuivit(0);
	}
	
	private function addSuivit ($bilan) {
	    if ($bilan == 0) {
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(133,5,4,0,0,0,6,3,7,0,7,0,2,0,0,2,0,2,0,2,0,1,6,0,13,154);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(132,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,0,13,153);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(131,0,0,0,0,0,2,0,2,0,0,0,0,0,0,3,0,0,6,0,0,0,0,0,13,152);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(130,0,5,3,4,3,2,4,3,4,2,4,3,2,1,5,4,3,3,2,2,1,1,0,13,151);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(129,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,13,150);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(128,0,3,4,0,5,2,0,6,5,3,2,1,5,3,6,3,6,4,2,6,3,6,0,13,149);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(127,1,2,1,3,1,4,1,5,1,5,1,1,0,0,2,1,3,1,4,1,5,1,0,13,148);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(126,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,0,13,147);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(125,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,0,13,146);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(124,2,3,5,6,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,0,13,145);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(123,3,1,3,1,6,6,2,4,6,4,6,1,4,2,3,6,4,3,6,2,4,6,0,13,144);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(122,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,13,143);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(121,0,3,0,6,0,2,4,6,3,5,2,6,3,6,3,6,1,3,5,6,2,4,0,13,142);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(120,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,13,141);
    	    EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(119,1,3,5,6,6,2,3,6,2,4,1,5,1,0,0,4,2,6,4,5,1,3,0,13,140);
	    }
	    else {
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(148,5,4,0,0,0,6,3,7,0,7,0,2,0,0,2,0,2,0,2,0,1,6,1,13,154);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(147,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,1,13,153);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(146,0,0,0,0,0,2,0,2,0,0,0,0,0,0,3,0,0,6,0,0,0,0,1,13,152);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(145,0,5,3,4,3,2,4,3,4,2,4,3,2,1,5,4,3,3,2,2,1,1,1,13,151);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(144,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,13,150);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(143,0,3,4,0,5,2,0,6,5,3,2,1,5,3,6,3,6,4,2,6,3,6,1,13,149);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(142,1,2,1,3,1,4,1,5,1,5,1,1,0,0,2,1,3,1,4,1,5,1,1,13,148);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(141,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,1,13,147);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(140,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,13,146);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(139,2,3,5,6,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,13,145);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(138,3,1,3,1,6,6,2,4,6,4,6,1,4,2,3,6,4,3,6,2,4,6,1,13,144);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(137,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,13,143);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(136,0,3,0,6,0,2,4,6,3,5,2,6,3,6,3,6,1,3,5,6,2,4,1,13,142);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(135,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,13,141);
	        EmployeurControllerTest::$evaluationBurnoutDAO->creerEvaluationburnoutCPL(134,1,3,5,6,6,2,3,6,2,4,1,5,1,0,0,4,2,6,4,5,1,3,1,13,140);
	    }
	}
	
	public function testGetDivisions () {
	    $results = json_decode (EmployeurControllerTest::$employeurController->getDivisions());
	    $this->assertSame(count($results), 9);
	}
	
// 	public function testGetGlobal () {
// 	    $results = json_decode (EmployeurControllerTest::$employeurController->getGlobal());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	    $results = json_decode (EmployeurControllerTest::$employeurController->getGlobal(185));
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
// 	public function testStress () {
// 	    $results = json_decode (EmployeurControllerTest::$employeurController->stress ());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	    $results = json_decode (EmployeurControllerTest::$employeurController->stress (188));
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	    $this->assertSame($results->values[0],2.6666666666666665);
// 	}
	
	public function diplayBilanInit () {
	    $results = json_decode (EmployeurControllerTest::$employeurController->diplayBilanInit());
	    $this->assertSame(count($results->data1), 3);
	    $this->assertSame(count($results->data2), 3);
	    $this->assertSame(count($results->data3), 3);
	}
	
	public function diplayBilanFin () {
	    $results = json_decode (EmployeurControllerTest::$employeurController->diplayBilanFin());
	    $this->assertSame(count($results->data1), 3);
	    $this->assertSame(count($results->data2), 3);
	    $this->assertSame(count($results->data3), 3);
	}
	
	public function testDeconnexion () {
	    EmployeurControllerTest::$employeurController->deconnexion ();
	    $this->assertTrue (session_status () != PHP_SESSION_ACTIVE);
	}
	
}