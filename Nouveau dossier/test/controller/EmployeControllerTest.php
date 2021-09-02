<?php
use PHPUnit\Framework\TestCase;

class EmployeControllerTest extends TestCase
{
    private static $employeController;
    private static $employeurDAO;
    private static $evaluationBurnoutDAO; 
    private static $employeDAO;
    private static $suivitEmployeDAO;
	
	public static function setUpBeforeClass() : void
	{
	    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeController.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/SuivitEmploye.php");
	    EmployeControllerTest::$employeController = new EmployeController;
	    EmployeControllerTest::$employeurDAO = new Employeur;
	    EmployeControllerTest::$evaluationBurnoutDAO = new Evaluationburnout;
	    EmployeControllerTest::$employeDAO = new Employe;
	    EmployeControllerTest::$suivitEmployeDAO = new SuivitEmploye;
	}

	public function testConnexion () {
	    EmployeControllerTest::$employeDAO->resetLastTentativeAndlastConnexion("142");
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "AA%ist-esa4";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::success);
	    $this->assertSame($_SESSION["idEmploye"],"142");
	    	
	    $_POST['login'] = "wrongUser@mail.fr";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	}
	
	public function testFiveMinutesBlockConnexion () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "AA%ist-esa5";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	    
	    $_POST['motdepasse'] = "AA%ist-esa4";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	}
	
	public function testConnexionAfterFiveMinuteblock () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "AA%ist-esa4";
	    EmployeControllerTest::$employeDAO->setLastTentative5minutesAgo("142");
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::success);
	    
	    $employe = EmployeControllerTest::$employeDAO->findById("142")[0];
	    $this->assertSame($employe->getNbTentatives(), "0");
	}
	
	public function test1DayBlockConnexion () {
	    $_POST['login'] = "amselem.jonathan@gmail.com";
	    $_POST['motdepasse'] = "AA%ist-esa5";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failFiveMinutes);
	    
	    EmployeControllerTest::$employeDAO->setLastTentative5minutesAgo("142");
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::fail);
	    
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failDay);
	    
	    $_POST['motdepasse'] = "AA%ist-esa4";
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, TIME_LIMIT::failDay);
	    
	    EmployeControllerTest::$employeDAO->setLastTentative1Day("142");
	    $result = EmployeControllerTest::$employeController->connexion();
	    $this->assertSame($result, STATUS::success);
	    
	    $employe = EmployeControllerTest::$employeDAO->findById("142")[0];
	    $this->assertSame($employe->getNbTentatives(), "0");
	}
	
	
	// 	    ("DEB" => Display Evolution Bienêtre,
	// 	    "FBF" => Faire Bilan Final,
	//      "DBF" => Display Bilan Final,
	//      "FBI" => Faire Bilan Initial,
	//      "DBI" => Display Bilan Initial,
	//      "DEEBES" => Effectuer Bilan Bien Etre Semaine);
	public function testGetSideBarVariablesEvaluationBurnout () {
	    $_SESSION["idEmploye"] = "142";
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
        //EvaluationBurnout semaine 0 mais pas 1 et Employeur bilan = 0
	    $this->assertFalse($result["FBI"]);
	    $this->assertTrue($result["DBI"]);
	    $this->assertFalse($result["FBF"]);
	    $this->assertFalse($result["DBF"]);
	   
	    //set le bilan de l'entreprise à 1
	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 1, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
	    $this->assertFalse($result["FBI"]);
	    $this->assertTrue($result["DBI"]);
	    $this->assertTrue($result["FBF"]);
	    $this->assertFalse($result["DBF"]);
	    
	    //Inserer l'evaluation burnout de la semaine 1 
	    echo "addEvaluationBurnout: " . $this->addEvaluationBurnout(1);
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
	    $this->assertFalse($result["FBI"]);
	    $this->assertTrue($result["DBI"]);
	    $this->assertFalse($result["FBF"]);
	    $this->assertTrue($result["DBF"]);
	    
// 	    //Supprimer les evaluations Burnout (semaine 0 et 1) de l'employe "142)
// 	    //set le bilan de l'entreprise à 0
	    EmployeControllerTest::$evaluationBurnoutDAO->deleteEvaluationBurnout($_SESSION["idEmploye"]);
	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 0, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
	    $this->assertTrue($result["FBI"]);
	    $this->assertFalse($result["DBI"]);
	    $this->assertFalse($result["FBF"]);
	    $this->assertFalse($result["DBF"]);
	    $this->addEvaluationBurnout(0);
	}
	
	private function addEvaluationBurnout ($bilan) {
	    EmployeControllerTest::$evaluationBurnoutDAO->insertEvaluationBurnout(6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,6,2,$bilan,13,142);
	}
	
	
	public function testDisplayBilanSemaine () {
	    //$_SESSION['entreprise'] = 13;
	    //$_SESSION["idEmploye"] = "142";
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
	    $this->assertFalse($result["DEEBES"]);
	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 1, 9, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
	    $result = EmployeControllerTest::$employeController->getSideBarVariables();
	    $this->assertTrue($result["DEEBES"]);
	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 0, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
	}
	
	
// 	public function testgetGlobal () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->getGlobal ());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
	
// 	public function testStress () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->stress ());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
// 	public function testAnxiete () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->anxiete());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
// 	public function testEnergie () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->energie());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
// 	public function testSommeil () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->sommeil());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
// 	public function testDigestion () {
// 	    $results = json_decode (EmployeControllerTest::$employeController->digestion());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	}
	
	
	public function diplayBilanInit () {
	    $results = json_decode (EmployeControllerTest::$employeController->diplayBilanInit());
	    $this->assertSame(count($results->data1), 3);
	    $this->assertSame(count($results->data2), 3);
	    $this->assertSame(count($results->data3), 3);
	}
	
	
	public function diplayBilanFin () {
	    $results = json_decode (EmployeControllerTest::$employeController->diplayBilanFin());
	    $this->assertSame(count($results->data1), 3);
	    $this->assertSame(count($results->data2), 3);
	    $this->assertSame(count($results->data3), 3);
	}
	
	
	public function testSubmitBurnout () {
	    $_POST['bilan'] = 1;
	    $_POST['Question1'] = 1;
	    $_POST['Question2'] = 2;
	    $_POST['Question3'] = 3;
	    $_POST['Question6'] = 4;
	    $_POST['Question8'] = 5;
	    $_POST['Question13'] = 6;
	    $_POST['Question14'] = 1;
	    $_POST['Question16'] = 2;
	    $_POST['Question20'] = 3;
	    $_POST['Question5'] = 4;
	    $_POST['Question10'] = 5;
	    $_POST['Question11'] = 6;
	    $_POST['Question15'] = 1;
	    $_POST['Question22'] = 2;
	    $_POST['Question4'] = 3;
	    $_POST['Question7'] = 4;
	    $_POST['Question9'] = 5;
	    $_POST['Question12'] = 6;
	    $_POST['Question17'] = 1;
	    $_POST['Question18'] = 2;
	    $_POST['Question19'] = 3;
	    $_POST['Question21'] = 4;
	    $result = json_decode(EmployeControllerTest::$employeController->submitBurnout());
	    //(['sap'=> $resultatSAP, 'sd'=> $resultatSD, 'sep'=> $resultatSEP])
	    $this->assertSame($result->sap, 28);
	    $this->assertSame($result->sd,  18);
	    $this->assertSame($result->sep, 27);
	    $suivi = EmployeControllerTest::$evaluationBurnoutDAO->getEvaluationBurnoutById($_SESSION["idEmploye"],1);
	    $this->assertSame(count($suivi), 1);
	    EmployeControllerTest::$evaluationBurnoutDAO->deleteEvaluationBurnout($_SESSION["idEmploye"]);
	    $this->addEvaluationBurnout(0);
	}
	
// 	public function testSubmitSuivi () {
// 	    $_POST['bilan'] = 1;
// 	    $_POST['Question1'] = 1;
// 	    $_POST['Question2'] = 2;
// 	    $_POST['Question3'] = 3;
// 	    $_POST['Question4'] = 1;
// 	    $_POST['Question5'] = 2;
// 	    //semaine = 8
// 	    $results = json_decode (EmployeControllerTest::$employeController->submitSuivit());
// 	    $this->assertSame(count($results->label), 8);
// 	    $this->assertSame(count($results->values), 8);
// 	    //set de la semaine à 9 
// 	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 0, 9, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
// 	    $results = json_decode (EmployeControllerTest::$employeController->submitSuivit());
// 	    $this->assertSame(count($results->label), 9);
// 	    $this->assertSame(count($results->values), 9);
// 	    EmployeControllerTest::$suivitEmployeDAO->deleteSuivitEmploye(142, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 4, 1, 5, 4, 8, 1, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 8, 7, 8, 8, 4, 2, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 3, 8, 5, 9, 1, 3, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 7, 8, 8, 4, 4, 4, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 7, 8, 8, 4, 4, 5, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 9, 4, 0, 6, 4, 6, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 8, 9, 4, 4, 9, 7, 13);
// 	    EmployeControllerTest::$suivitEmployeDAO->addSuivitEmploye(142, 9, 7, 5, 9, 1, 8, 13);
// 	    EmployeControllerTest::$employeurDAO->updateEmployeur("eurogiciel", "dirigeant", "siret", "ape", 0, 8, md5("amselem.jonathan@gmail.com"), '$2y$10$FMN1wdU8M2E.U/IolBLvK.hwl5pPPnBiWpzhpbt3DYkXcyzHBQvr2', 13);
// 	}
	
	public function testDeconnexion () {
	    EmployeControllerTest::$employeController->deconnexion ();
	    $this->assertTrue (session_status () != PHP_SESSION_ACTIVE);
	}
	
}