<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Utils.php");
//include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/CommonController.php");

/**
 * Class Employe
 */
class EmployeController
{
	private $employeurDAO; 
	private $employeDAO;
	//private $commonController;
	
	function __construct() {
        $this->employeDAO = new Employe;
		$this->employeurDAO = new Employeur;
		//$this->commonController = new CommonController;
    }

    
    public function lastConnexion() {
        return Utils::lastConnexion($this->employeDAO,ID::idEmploye);
    }
    /**
	* renvoie les variables afin d'afficher (ou pas) les items du menu
	*/
	public function getSideBarVariables () {
		$MIBVariables = $this->getMBIVariables ();
		return $MIBVariables + $this->getDisplaySuivitVariables () + $this->getDoModifySuivitVariables ($MIBVariables["tmp"]);
	}
	
	private function getMBIVariables () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$tmp = $this->employeurDAO->getEmployeurById ($employe->getIdEntreprise()) [0];
		
		$bilan = $tmp->getBilan();
				
		if ($bilan == 0) { //Il faut faire le premier bilan si celui-ci n'a pas été encore fait
			// Le bilan final n'est ni fait ni à faire
			$FBF = false; // ne pas proposer de faire le bilan final
			$DBF = false; // ne pas afficher le bilan final qui n'existe pas

			$sqlResult = $this->evaluationBurnoutDAO->getEvaluationBurnoutById ($_SESSION[ID::idEmploye], 0);
			if(count($sqlResult)>0) { //le bilan initial a été fait

				$FBI = false; // ne pas proposer de faire le bilan initial
				$DBI = true;  // afficher le bilan initial
			}
			else { //le bilan initial n'a pas été fait

				$FBI = true; // proposer de faire le bilan initial
				$DBI = false;// ne pas afficher le bilan initial
			}
		} else if ($bilan == 1) { //Il faut faire le second bilan si celui-ci n'a pas été encore fait
			// Le bilan initial n'est est fait
			$FBI = false; // ne pas proposer de faire le bilan initial
			$DBI = true;  // afficher le bilan initial

			$sqlResult = $this->evaluationBurnoutDAO->getEvaluationBurnoutById ($_SESSION[ID::idEmploye], 1);

			if (count($sqlResult)>0) { //le bilan final a été fait

				$FBF = false; // ne pas faire le bilan final il a déjà été fait
				$DBF = true;  // afficher le resultat du bilant final

			} else { //le bilan final n'a pas été fait

				$FBF = true; // proposer de faire le bilan final il a déjà été fait
				$DBF = false; // ne pas afficher le resultat du bilan final car il n'a pas été fait
			}
		}
		return array("tmp" => $tmp, "FBF" => $FBF, "DBF" => $DBF, "FBI" => $FBI, "DBI" => $DBI);
	}

	private function getDisplaySuivitVariables () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$resultsuivit = $this->suivitEmployeDAO->getSuivitEmployeByIdEmploye ($_SESSION[ID::idEmploye]);
		if(count($resultsuivit) > 0) { //Il y a au moins 2 évaluations bien être
			$DEB = true; // Nous pouvons afficher dans le menu Evolution du bien être
		} else {
			$DEB = false; //Nous n'affichons pas dans le menu Evolution du bien être
		}	
		
		return array("DEB" => $DEB);
	}
	
	private function getDoModifySuivitVariables ($employeur){
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$resultSuivitSemaine = $this->suivitEmployeDAO->getSuivitsEmployesByEmployeIdAndWeek ($_SESSION[ID::idEmploye],$employeur->getSemaine());
		if(count($resultSuivitSemaine)>0) { //l'évaluation bien être de la semaine est faite
			$DEEBES = false; // Nous ne proposons pas d'effectuer l'Evaluation du bien être de la semaine
		} else {
			$DEEBES = true; // Nous proposons d'effectuer l'Evaluation du bien être de la semaine
		}
		return array("DEEBES" => $DEEBES);
	}
	
	function getInfoPersoEmploye () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$sqlResult = $this->employeDAO->findById($_SESSION[ID::idEmploye]);
		$sqlentreprise = $this->employeurDAO->findById($employe->getIdEntreprise());
		

		$result ='<table class="table table-primary table-hover">
		<thead class="thead-primary">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Entreprise</th>
                <th scope="col">Divisions</th>
			</tr>
		</thead>
		<tbody>';


		if($sqlResult != null)
		{
		    $divisions_employe = $this->division_EmployeDAO->findByIdEmploye($_SESSION[ID::idEmploye]);
		    $divisions = $this->getDivisionsFormIds ($divisions_employe);
		    
			$result .= "<tr>";
			$result .= "<td>" . $sqlResult[0]->getId() . "</td>";
			$result .= "<td>" . $sqlentreprise[0]->getNomEntreprise() . "</td>";
			$result .= "<td>$divisions</td>";
			$result .= '</tbody>
			</table><br/>';
			
			$result .= '<button type="button" class="btn btn-primary" onclick="downloadEmployeInfo()">T&eacute;l&eacute;charger</button><br/><br/><br/><br/>';
			echo $result;
		} else {
		  echo "error no employe found";
		}
	}
	
	private function getDivisionsFormIds ($divisions_employe) {
	    $result = "";
	    $nbResult = count($divisions_employe);
	    if ($nbResult>0) {
	        for ($i=0; $i<$nbResult-1;$i++) {
	            $division =  $this->divisionDAO->findById($divisions_employe[$i]->getId_division())[0];
	            $result .= $division->getNom() . ",";
	        }
	        $division =  $this->divisionDAO->findById($divisions_employe[$nbResult-1]->getId_division())[0];
	        $result .= $division->getNom();
	    }
	    return $result;
	}

    public function getAll ($id_division=0) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $result = json_encode(
            ["global" => $this->getGlobal($id_division),
                "stress" => $this->stress($id_division),
                "anxiete" => $this->anxiete($id_division),
                "energie" => $this->energie($id_division),
                "sommeil" => $this->sommeil($id_division),
                "digestion" => $this->digestion($id_division)]);
        return $result;
    }

	private function getGlobal () {
		return $this->createEvolutionChart ("global");
	}

    private function stress () {
		return $this->createEvolutionChart("stress");
	}

    private function anxiete () {
		return $this->createEvolutionChart("anxiete");
	}

    private function energie () {
		return $this->createEvolutionChart("energie");
	}

    private function sommeil () {
		return $this->createEvolutionChart("sommeil");
	}

    private function digestion () {
		return $this->createEvolutionChart("digestion");
	}
	
	private function createEvolutionChart ($title) {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$results = $this->suivitEmployeDAO->getSuivitsEmployesByEmployeIdAndEntrepriseIdByWeek ($_SESSION[ID::idEmploye],$employe->getIdEntreprise());
		$plots = array();
		$labels = array();
		
		foreach ($results as $result){
			switch ($title) {
				case "stress":
				array_push($plots, $result->getStress());
				break; 
				case "anxiete":
				array_push($plots, $result->getAnxiete());
				break;
				case "digestion":
				array_push($plots, $result->getDigestion());
				break;
				case "energie":
				array_push($plots, $result->getEnergie());
				break;
				case "sommeil":
				array_push($plots, $result->getSommeil());
				break;
				case "global":
				$average = ($result->getSommeil() + (10 - $result->getStress()) + (10 - $result->getAnxiete()) + $result->getEnergie() +  $result->getDigestion()) / 5;
				array_push($plots, $average);
				break;
			}
			array_push($labels, "semaine" . $result->getSemaine());
		}
		return array (["label"=>$labels,"values"=>$plots]);
	}
	
	
	public function submitBurnout () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$result =	"<h1>R�sultats d'Inventaire de Burnout de Maslach - MBI</h1>";

		$resultatSEP = $_POST['Question1'] + $_POST['Question2'] + $_POST['Question3'] + $_POST['Question6'] + $_POST['Question8'] +$_POST['Question13'] + $_POST['Question14'] + $_POST['Question16'] + $_POST['Question20'];
		$resultatSD = $_POST['Question5'] + $_POST['Question10'] + $_POST['Question11'] + $_POST['Question15'] + $_POST['Question22'];
		$resultatSAP = $_POST['Question4'] + $_POST['Question7'] + $_POST['Question9'] + $_POST['Question12'] + $_POST['Question17'] + $_POST['Question18'] + $_POST['Question19'] + $_POST['Question21'];

		// On ajoute une entrée dans la table evaluationburnout
		$this->evaluationBurnoutDAO->insertEvaluationBurnout($_POST['Question1'], $_POST['Question2'], $_POST['Question3'], $_POST['Question4'], $_POST['Question5'], $_POST['Question6'], $_POST['Question7'], $_POST['Question8'], $_POST['Question9'], $_POST['Question10'],
													  $_POST['Question11'], $_POST['Question12'], $_POST['Question13'], $_POST['Question14'], $_POST['Question15'], $_POST['Question16'], $_POST['Question17'], $_POST['Question18'],
		    $_POST['Question19'], $_POST['Question20'], $_POST['Question21'], $_POST['Question22'], $_POST['bilan'], $employe->getIdEntreprise(), $_SESSION[ID::idEmploye]);

		return json_encode(['sap'=> $resultatSAP, 'sd'=> $resultatSD, 'sep'=> $resultatSEP]);
	}
	
	/**
	* renvoie le resultat du bilan initial de l'employé
	**/
	public function diplayBilanInit () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$results = $this->evaluationBurnoutDAO->getEvaluationBurnoutById ($_SESSION[ID::idEmploye], '0');
		return $this->getChartLink ($results);
	}
	
	/**
	* renvoie le resultat du bilan final de l'employé
	**/
	public function diplayBilanFin () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$results = $this->evaluationBurnoutDAO->getEvaluationBurnoutById ($_SESSION[ID::idEmploye], '1');
		return $this->getChartLink ($results);
	}
	
	private function getChartLink ($results) {
		if(count ($results) == 1) { //le bilan a été fait

			$donnees = $results [0];
			$resultatSEP = $donnees->getQuestion1() + $donnees->getQuestion2() + $donnees->getQuestion3() + $donnees->getQuestion6() + $donnees->getQuestion8() +$donnees->getQuestion13() + $donnees->getQuestion14() + $donnees->getQuestion16() + $donnees->getQuestion20();
			$resultatSD = $donnees->getQuestion5() + $donnees->getQuestion10() + $donnees->getQuestion11() + $donnees->getQuestion15() + $donnees->getQuestion22();
			$resultatSAP = $donnees->getQuestion4() + $donnees->getQuestion7() + $donnees->getQuestion9() + $donnees->getQuestion12() + $donnees->getQuestion17() + $donnees->getQuestion18() + $donnees->getQuestion19() + $donnees->getQuestion21();
			
			return json_encode(['sap'=> $resultatSAP, 'sd'=> $resultatSD, 'sep'=> $resultatSEP]);
		}
	}
	
	public function submitSuivit () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
		$results = $this->employeurDAO->findById($employe->getIdEntreprise());
		
		if(count ($results) == 1) {
			$semaine = $results[0]->getSemaine();

			$sqlResult = $this->suivitEmployeDAO->getSuivitEmployeByidEmployeAndWeekAndEntrepriseId($_SESSION[ID::idEmploye],$semaine, $employe->getIdEntreprise());
			
			if(count ($sqlResult) == 1) { //le bilan a été fait // si la ligne existe nous mettons à jours la ligne
			    $this->suivitEmployeDAO->updateSuivitEmploye($_POST['Question1'],$_POST['Question2'],$_POST['Question3'],$_POST['Question4'],$_POST['Question5'],$_SESSION[ID::idEmploye],$semaine, $employe->getIdEntreprise());	
		
			} else {	
				// On ajoute une entrée dans la table suivitemploye
			    $this->suivitEmployeDAO->addSuivitEmploye ($_SESSION[ID::idEmploye],$_POST['Question1'],$_POST['Question2'],$_POST['Question3'],$_POST['Question4'],$_POST['Question5'],$semaine, $employe->getIdEntreprise());							  
			}
		}
		return $this->getGlobal ();
	}
	
	public function downloadEmployeInfo () { 
	    if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        // 	    On cr�e un fichier dans lequel on va stocker nos donn�es
	    $fp = fopen('./file.csv', 'w');
	    //On initialise les deux premi�re lignes avec un Titre et les colonnes s�l�ctionn�es
	    
	    $employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
	    fputcsv($fp, array("Informations personnelles"),';');
	    fputcsv($fp, array('num Employe','Entreprise', 'Divisions'),';');
	   
	    $entreprise = $this->employeurDAO->getEmployeurById($employe->getIdEntreprise())[0];
	    $divisions_employe = $this->division_EmployeDAO->findByIdEmploye($_SESSION[ID::idEmploye]);
	    $divisions = $this->getDivisionsFormIds ($divisions_employe);
	    
	    fputcsv($fp, array($employe->getId(), $entreprise->getNomEntreprise(), $divisions), ';');
	    
	    $firstEvaluation  = $this->evaluationBurnoutDAO->findBySemaineAndIdEntrepriseAndIdEmploye(0,$employe->getIdEntreprise(),$_SESSION[ID::idEmploye]);
	    
	    if ($firstEvaluation != NULL){
	        $this->evaluationTable ($firstEvaluation, 1, $fp);
	        $suivisEmploye = $this->suivitEmployeDAO->getSuivitEmployeByIdEmploye($_SESSION[ID::idEmploye]);
	        fputcsv($fp, array("Suivi bien-etre"),';');
	        fputcsv($fp, array('semaine','sommeil', 'stress', 'anxiete', 'energie', 'digestion'),';');
	        
	        foreach ($suivisEmploye as $suiviEmploye) {
	            fputcsv($fp, array($suiviEmploye->getSemaine(), $suiviEmploye->getSommeil(), $suiviEmploye->getStress(),
	                               $suiviEmploye->getAnxiete(), $suiviEmploye->getEnergie(), $suiviEmploye->getDigestion()) , ';');
	        }
	        
	        if (count($suivisEmploye) > 0){
	            $secondEvaluation = $this->evaluationBurnoutDAO->findBySemaineAndIdEntrepriseAndIdEmploye(1,$employe->getIdEntreprise(),$_SESSION[ID::idEmploye]);
	            if ($secondEvaluation != NULL){
	                $this->evaluationTable ($secondEvaluation, 2, $fp);
	            }
	        }
	    }
	    // On ferme le fichier
	    fclose($fp);
	    
	    $fichier = "file.csv";
	    $chemin="./file.csv";
	    
	    header('Content-disposition: attachment; filename="' . $fichier . '"');
	    header('Content-Type: application/force-download');
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: ' . filesize($chemin));
	    header('Pragma: no-cache');
	    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	    header('Expires: 0');
	    readfile($chemin);
}

private function evaluationTable ($evaluation, $noEvaluation, $fp) {
    fputcsv($fp, array("Evaluation Burnout numero $noEvaluation"),';');
    fputcsv($fp, array('question 1','question 2', 'question 3', 'question 4', 'question 5', 'question 6'
                        , 'question 7', 'question 8', 'question 9', 'question 10', 'question 11', 'question 12', 'question 13'
                        , 'question 14', 'question 15', 'question 16', 'question 17', 'question 18', 'question 19', 'question 20'
                        , 'question 21', 'question 22'),';');
    
    fputcsv($fp, array($evaluation->getQuestion1(), $evaluation->getQuestion2(), $evaluation->getQuestion3(), $evaluation->getQuestion4(), $evaluation->getQuestion5(), $evaluation->getQuestion6()
                        , $evaluation->getQuestion7(), $evaluation->getQuestion8(), $evaluation->getQuestion9(), $evaluation->getQuestion10(), $evaluation->getQuestion11(), $evaluation->getQuestion12(), $evaluation->getQuestion13()
                        , $evaluation->getQuestion14(), $evaluation->getQuestion15(), $evaluation->getQuestion16(), $evaluation->getQuestion17(), $evaluation->getQuestion18(), $evaluation->getQuestion19(), $evaluation->getQuestion20()
                        , $evaluation->getQuestion21(), $evaluation->getQuestion22()),';');
}
	

	public function connexion() {
	    return Utils::connexion($this->employeDAO, ID::idEmploye);
	}
	
	public function renouvelerMotDePasse () {
	    return Utils::renouvelerMotDePasse($this->employeDAO, ID::idEmploye);
	}
	
	public function sendRenewPasswordMail () {
	    Utils::sendRenewPasswordMail($this->employeDAO);
	}
	
	public function deconnexion () {
	    Utils::deconnexion();
	}
	
	// public function logoEntreprise () {
	//     if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
	//     $employe = $this->employeDAO->findById($_SESSION[ID::idEmploye])[0];
	//     $this->commonController->logoEntreprise ($employe->getIdEntreprise());
	// }
	
}


