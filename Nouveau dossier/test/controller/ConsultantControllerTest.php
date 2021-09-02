<?php
use PHPUnit\Framework\TestCase;

/**
 * Class ConsultantControllerTest
 */
class ConsultantControllerTest extends TestCase
{
    private static $consultantController;
//     private static $evaluationBurnoutDAO; 
    private static $consultantDAO;
	
	public static function setUpBeforeClass() : void
	{
	    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../..";
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/consultantController.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
	    include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Consultant.php");
	    ConsultantControllerTest::$consultantController = new consultantController;
// 	    ConsultantControllerTest::$evaluationBurnoutDAO = new Evaluationburnout;
	    ConsultantControllerTest::$consultantDAO = new Consultant;
	}

	public function testConnexion () {
	    $_POST['login'] = "jonathan.amselem.pro@gmail.com";
	    $_POST['motdepasse'] = 'AA%ist-esa3';
	    $result = ConsultantControllerTest::$consultantController->connexion();
	    $this->assertSame($result, "success");
	    $this->assertSame($_SESSION["consultant"],'1');
	    	
	    $_POST['login'] = "wrongUser@mail.fr";
	    $result = ConsultantControllerTest::$consultantController->connexion();
	    $this->assertSame($result, "fail");
	    
	    $_POST['login'] = "jonathan.amselem.pro@gmail.com";
	    $_POST['motdepasse'] = "wrongpassword";
	    $result = ConsultantControllerTest::$consultantController->connexion();
	    $this->assertSame($result, "fail");
	}
	
	
	public function testDeconnexion () {
	    ConsultantControllerTest::$consultantController->deconnexion ();
	    $this->assertTrue (session_status () != PHP_SESSION_ACTIVE);
	}
	
}