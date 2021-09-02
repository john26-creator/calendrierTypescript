<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Utils.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/CommonController.php");

/**
 * Class Employeur
 */
class EmployeurController
{
	private $employeurDAO; 
	private $employeDAO;
	private $commonController;
	
	function __construct() {
        $this->employeDAO = new Employe;
		$this->employeurDAO = new Employeur;
		$this->commonController = new CommonController;
    }
    
    public function lastConnexion() {
        return Utils::lastConnexion($this->employeurDAO,ID::idEmployeur);
    }

	public function getDivisions () {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->getDivisions ($_SESSION[ID::idEmployeur]);
	}
	
	/**
	* retourne un tableau associatif ("DBI" => $DBI, "DBF" => $DBF)
	* DBI = Display Bilan Initial
	* DBF = Display Bilan Final
	*/
	public function getDisplayBarVariables () { 
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		return $this->commonController->getDisplayBarVariables ($_SESSION[ID::idEmployeur]);
	}
	
	function getInfoPersoEmployeur () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		return $this->commonController->getInfoPersoEmployeur($_SESSION[ID::idEmployeur]);
	}
	
	/**
	* Creation du graphes de suivit bien être global
	* Moyenne des indicateur bien être (sommeil, energie...)
	*/
	private function getGlobal ($id_division=0) {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		return $this->commonController->getGlobal ($id_division, $_SESSION[ID::idEmployeur]);
	}

	private function stress ($id_division=0) {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->createEvolutionChart("stress",$id_division,$_SESSION[ID::idEmployeur]);
	}

	public function getAll ($id_division=0) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $result = json_encode(["global" => $this->getGlobal($id_division), "stress" => $this->stress($id_division)]);
        return $result;
    }

	/*public function anxiete ($id_division=0) {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->createEvolutionChart("anxiete",$id_division,$_SESSION[ID::idEmployeur]);
	}

	public function energie ($id_division=0) {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->createEvolutionChart("energie",$id_division,$_SESSION[ID::idEmployeur]);
	}

	public function sommeil ($id_division=0) {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->createEvolutionChart("sommeil",$id_division,$_SESSION[ID::idEmployeur]);
	}

	public function digestion ($id_division=0) {
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	    return $this->commonController->createEvolutionChart("digestion",$id_division,$_SESSION[ID::idEmployeur]);
	}*/

	/**
	* créer le chart des bilans finaux des employés
	**/
	public function diplayBilanInit ($id_division=0) {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		return $this->commonController->diplayBilanInit($id_division, $_SESSION[ID::idEmployeur]);
	}

    /**
	* créer le chart des bilans finaux des employés
	**/
	public function diplayBilanFin ($id_division=0) {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		return $this->commonController->diplayBilanFin($id_division, $_SESSION[ID::idEmployeur]);
	}
	
	public function connexion() {
	    return Utils::connexion($this->employeurDAO, ID::idEmployeur);
    }
    
    public function renouvelerMotDePasse () {
        return Utils::renouvelerMotDePasse($this->employeurDAO, ID::idEmployeur);
    }
    
    public function sendRenewPasswordMail () {
        Utils::sendRenewPasswordMail($this->employeurDAO);
    }
    
    public function deconnexion () {
        Utils::deconnexion();
    }
    
	
	public function logoEntreprise () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$this->commonController->logoEntreprise ($_SESSION[ID::idEmployeur]);
	}
	
}