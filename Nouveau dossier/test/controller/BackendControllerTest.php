<?php
use PHPUnit\Framework\TestCase;

/**
 * Class Employeur
 */
class BackendControllerTest extends TestCase
{
    private static $backendController;
    private static $employeurDAO;
    private static $evaluationBurnoutDAO;
    private static $employeDAO;
    private static $suivitEmployeDAO;
	
	public static function setUpBeforeClass() : void
	{
	    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/BackendController.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/SuivitEmploye.php");
	    BackendControllerTest::$employeurDAO = new Employeur;
	    BackendControllerTest::$evaluationBurnoutDAO = new Evaluationburnout;
	    BackendControllerTest::$employeDAO = new Employe;
	    BackendControllerTest::$suivitEmployeDAO = new SuivitEmploye;
	    BackendControllerTest::$backendController = new BackendController;
	}

	public function testConnexion () {
	    $_POST['login'] = "jonathan.amselem.pro@gmail.com";
	    $_POST['motdepasse'] = "o9lk/%A1?";
	    $result = BackendControllerTest::$backendController->connexion();
	    $this->assertSame($result, "success");
	    $this->assertSame($_SESSION["id"],"1");
	    	
	    $_POST['login'] = "wrongUser@mail.fr";
	    $result = BackendControllerTest::$backendController->connexion();
	    $this->assertSame($result, "fail");
	    
	    $_POST['login'] = "jonathan.amselem.pro@gmail.com";
	    $_POST['motdepasse'] = "wrongpassword";
	    $result = BackendControllerTest::$backendController->connexion();
	    $this->assertSame($result, "fail");
	}
	
	public function testCreerEntreprise () {
	    //creerEntreprise
	    $_POST['entreprise'] = "testNom";
	    $_POST['dirigeant'] = "testDirigeant";
	    $_POST['siret'] = "testSiret";
	    $_POST['ape'] = "testAPE";
	    $_POST['adresse'] = "testAdresse";
	    $_POST['email'] = "testemail@test.fr";
	    $_POST['password'] = "AA%ist-esa3";
	    
	    BackendControllerTest::$backendController->creerEntreprise();
	    $results = BackendControllerTest::$employeurDAO->findByEmail(md5("testemail@test.fr"));
	    $this->assertTrue(count($results)==1);
	}
	
	public function testDeleteEntreprise () {
	    $results = BackendControllerTest::$employeurDAO->findByEmail(md5("testemail@test.fr"));
	    $_POST['id'] = $results[0]->getId();
	    BackendControllerTest::$backendController->deleteEntreprise();
	    $results = BackendControllerTest::$employeurDAO->findByEmail(md5("testemail@test.fr"));
	    $this->assertTrue(count($results)==0);
	}
	
	
	public function testDeconnexion () {
	    BackendControllerTest::$backendController->deconnexion ();
	    $this->assertTrue (session_status () != PHP_SESSION_ACTIVE);
	}
	
	
}