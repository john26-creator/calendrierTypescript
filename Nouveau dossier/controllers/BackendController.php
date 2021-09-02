<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Admin.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/SuivitEmploye.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Division.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Division_Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Consultant_Employeur.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Consultant.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Utils.php");

define ("JS_CONTROL", '<script type="text/javascript">
                (function() {
                	  "use strict";
                	  window.addEventListener("load", function() {
                	    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                	    var forms = document.getElementsByClassName("needs-validation");
                	    // Loop over them and prevent submission
                	    var validation = Array.prototype.filter.call(forms, function(form) {
                	      form.addEventListener("submit", function(event) {
                	        if (form.checkValidity() === false) {
                	          event.preventDefault();
                	          event.stopPropagation();
                	        }
                	        form.classList.add("was-validated");
                	      }, false);
                	    });
                	  }, false);
                	})();
                </script>');

/**
 * Class BackendController
 */
class BackendController
{
	private $employeurDAO; 
	private $employeDAO;        
	private $evaluationBurnoutDAO;    
	private $suivitEmployeDAO; 
	private $adminDAO;	
	private $divisionDAO;
	private $division_EmployeDAO;
	private $consultant_EmployeurDAO;
	private $consultantDAO;
	
	
	
	function __construct() {
        $this->employeDAO = new Employe;
		$this->evaluationBurnoutDAO = new Evaluationburnout;
		$this->suivitEmployeDAO = new SuivitEmploye;
		$this->employeurDAO = new Employeur;
		$this->adminDAO = new Admin;
		$this->divisionDAO = new Division;
		$this->division_EmployeDAO = new Division_Employe;
		$this->consultant_EmployeurDAO = new Consultant_Employeur;
		$this->consultantDAO = new Consultant;
    }
    
    public function lastConnexion () {
        return Utils::lastConnexion($this->adminDAO,ID::idAdministrateur);
    }
    
    public function findAll () {
        return $this->employeurDAO->findAll();
    }
    
    public function findAllConsultant () {
        return $this->consultantDAO->findAll();
    }
    
    public function deleteConsultant () {
        if(!isset($_POST['id'])) {return STATUS::fail;}
        $this->consultant_EmployeurDAO->deleteByConsultantId($_POST['id']);
        $this->consultantDAO->deleteConsultantById($_POST['id']);
    }
    
    public function displayCreerConsultant () {
        echo '<form id="form" class="needs-validation" method="post" onsubmit="creerConsultant(event);">';
        echo '<fieldset>';
        echo '	<legend>Cr&eacute;ation Consultant</legend>';
        echo ' <div class="form-row">';
        echo '	<div class="form-group col-md-6">';
        echo '		<label for="entreprise"> Nom : </label>';
        echo '		<input type="text" name="nom" placeholder="nom consultant" required="true" class="form-control" />';
        echo '    </div>';
        echo '    <div class="form-group col-md-6"> ';
        echo '		<label for="siret"> Pr&eacute;nom : </label>';
        echo '		<input type="text" placeholder="Prenom" name="prenom" required="true" class="form-control" />';
        echo '    </div>';
        echo '  </div>';
        
        echo '  <div class="form-row"> ';
        echo '	  <div class="form-group col-md-12">';
        echo '		<label for="email"> Email : </label>';
        echo '		<input type="email" class="form-control" placeholder="addresse mail" name="email" required="true"
                       class="form-control" />';
        echo '      <div class="valid-feedback">Valide</div>';
        echo '      <div class="invalid-feedback">Veuillez entrer un email valide</div>';
        echo '	  </div>';
        echo '  </div>';
        echo '	<div class="form-group col-md-12">';
        echo '    <input type="submit" class="btn btn-primary btn-lg" value="Envoyer"/>';
        echo '	</div>';
        echo '</fieldset>';
        echo '</form>';
        echo JS_CONTROL;
        echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
        
    }
    
    public function displayConsultantEntreprises () {
        if(!isset($_POST['id'])) {return STATUS::fail;}
        else {
            echo '<h2>Liste des Entreprise consultant</h2>
				<br/><br/>
                
				<table class="table table-primary table-hover">
				<thead class="thead-primary">
					<tr>
						<th scope="col">Entreprise</th>
						<th scope="col">checkBox</th>
					</tr>
					</thead>
				<tbody>';
            
            $entreprises = $this->employeurDAO->findAll();
            $consultant_employeurs = $this->consultant_EmployeurDAO->findByIdConsultant($_POST['id']);
            
            foreach ($entreprises as $entreprise){
                echo '<tr>';
                echo '<td>' . $entreprise->getNomEntreprise() . '</td> ';
                $checked = false;
                foreach ($consultant_employeurs as $consultant_employeur){
                    if ($consultant_employeur->getId_Employeur() == $entreprise->getId()) {
                        $checked = true;
                    }
                }
                if ($checked == true) {
                    $checked = "checked";
                } else {
                    $checked = "";
                }
                echo '<td> <input type="checkbox" ' . $checked . ' onchange="setEntreprise(event, \''.$entreprise->getId().'\',\''. $_POST['id'] . '\')"/></td> ';
                echo '</tr>';
            }
            
            echo '</tbody>
			</table>';
            echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour liste entreprise</button><br/>';
        }
    }
    
    public function setEntreprise () {
        if(!isset($_POST['idEntreprise']) || !isset($_POST['idConsultant'])) {return STATUS::fail;}
        else {
            $this->consultant_EmployeurDAO->addConsultant_Employeur($_POST['idConsultant'], $_POST['idEntreprise']);
            return STATUS::success;
        }
    }
    
    public function unSetEntreprise () {
        if(!isset($_POST['idEntreprise']) || !isset($_POST['idConsultant'])) {return STATUS::fail;}
        else {
            $this->consultant_EmployeurDAO->deleteByConsultantAndEmployeurId($_POST['idConsultant'], $_POST['idEntreprise']);
            return STATUS::success;
        }
    }
    
    public function displayConsultantForm () {
        if(!isset($_POST['id'])) {return STATUS::fail;}
        else {
            $consultant = $this->consultantDAO->findById($_POST['id'])[0];
            echo '<form id="form" class="needs-validation" method="post" onsubmit="updateConsultant(event, \'' . $consultant->getId() . '\');">';
            echo '<fieldset>';
            echo '	<legend>Modification Consultant</legend>';
            echo ' <div class="form-row">';
            echo '	<div class="form-group col-md-4">';
            echo '		<label for="entreprise"> Nom : </label>';
            echo '		<input type="text" name="nom" placeholder="nom consultant" required="true" class="form-control" value=\'' . $consultant->getNom() . '\'/>';
            echo '    </div>';
            echo '    <div class="form-group col-md-4"> ';
            echo '		<label for="prenom"> Pr&eacute;nom : </label>';
            echo '		<input type="text" placeholder="Prenom" name="prenom" required="true" class="form-control" value=\'' . $consultant->getPrenom() . '\'/>';
            echo '    </div>';
            echo ' <div class="form-group col-md-4"> ';
            echo '		<label for="email"> Email : </label>';
            echo '		<input type="email" class="form-control" placeholder="addresse mail" name="email" required="true" value=\'' . $consultant->getEmail() . '\'
                           class="form-control" />';
            echo '      <div class="valid-feedback">Valide</div>';
            echo '      <div class="invalid-feedback">Veuillez entrer un email valide</div>';
            echo '	  </div>';
            
            echo '	<div class="form-group col-md-12">';
            echo '    <input type="submit" class="btn btn-primary btn-lg" value="Envoyer"/>';
            echo '	</div>';
            echo '  </div>';
            echo '	<input name="id" type="hidden" value="'. $consultant->getId() . '"/>';
            echo '</fieldset>';
            echo '</form>';
            echo JS_CONTROL;
            echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
        }
    }
    
    public function creerConsultant () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        if(empty($_POST['email']) || empty($_POST['nom']) || empty($_POST['prenom'])) {return STATUS::fail;}
        else if(!Utils::isEmailValid($_POST['email'])) {return STATUS::fail;}
        else {
            $mail = htmlentities(strtolower(trim($_POST['email'])));
            $newPassword = Utils::RandPassword(8);
            $newEncryptedPassword = Utils::encryptPassword($newPassword);
            Utils::SendRenewPasswordEmail($mail, $newPassword);
            $this->consultantDAO->creerConsultant(md5($mail), $newEncryptedPassword, $_POST['nom'], $_POST['prenom']);
            return STATUS::success;
        }
    }
    
    public function updateConsultant () {
        if(empty($_POST['email']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['id']) ) {return STATUS::fail;}
        else if(!Utils::isEmailValid($_POST['email'])) {return STATUS::fail;}
        else {
            $mail = htmlentities(strtolower(trim($_POST['email'])));
            $this->consultantDAO->updateConsultantNoPassword($_POST['id'], md5($mail), $_POST['nom'], $_POST['prenom']);
            return STATUS::success;
        }
    }
    
	
	public function updateEmploye () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		if(empty($_POST['email'])) {return STATUS::fail;}
		if(!Utils::isEmailValid($_POST['email'])) {return STATUS::fail;}
		$this->employeDAO->updateMailEmploye($_POST['id'], md5($_POST['email']));
	}
	
	public function updateEmploye2 ($email, $motDePasse) {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		if(empty($email) || empty($motDePasse)) {return STATUS::fail;}
		if(!Utils::isEmailValid($email) || !Utils::isPasswordValid($motDePasse)) {return STATUS::fail;}
		$this->employeDAO->updateEmployeIdentifiers($_POST['id'], md5($email), $motDePasse);
	}
	
	public function updateEntreprise () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		if(empty($_POST ['email'])) {return STATUS::fail;}
		if(!Utils::isEmailValid($_POST ['email'])) {return STATUS::fail;}
		if(!empty($_POST['password']) && !Utils::isPasswordValid($_POST['password'])) {return STATUS::fail;}
		else if (!empty($_POST['password'])) {
		  $this->employeurDAO->updateEmployeur($_POST ['entreprise'], $_POST ['dirigeant'], $_POST ['siret'], $_POST ['ape'], $_POST ['bilan'], $_POST ['semaine'], md5($_POST ['email']), Utils::encryptPassword($_POST['password']), $_POST['id']);
		}
		else {
		    $this->employeurDAO->updateEmployeurNoPassword($_POST ['entreprise'], $_POST ['dirigeant'], $_POST ['siret'], $_POST ['ape'], $_POST ['bilan'], $_POST ['semaine'], md5($_POST ['email']), $_POST['id']);
		}
		$this->updateLogo ($_POST['id']);
	}

	public function creerEntreprise () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		if(empty($_POST ['email']) || empty($_POST['password'])) {return STATUS::fail;}
		if(!Utils::isEmailValid($_POST ['email']) || !Utils::isPasswordValid($_POST['password'])) {return STATUS::fail;}
		
		$idEntreprise = $this->employeurDAO->creerEmployeur($_POST['entreprise'], $_POST['dirigeant'], $_POST['siret'], $_POST['ape'], $_POST['adresse'], md5($_POST['email']), Utils::encryptPassword($_POST['password']));
		$this->updateLogo($idEntreprise);
	}

	
	private function updateLogo ($idEntreprise) {
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
		$path = 'uploads/'; // upload directory

		if(!empty($_FILES['file']['name']))
		{
			$img = $_FILES['file']['name'];
			$tmp = $_FILES['file']['tmp_name'];
			
			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

			// can upload same image using rand function
			$final_image = rand(1000,1000000).$img;

			// check's valid format
			if(in_array($ext, $valid_extensions)) 
			{ 
				$path = $path.strtolower($final_image);  
				$this->employeurDAO->updateLogo ($tmp,$idEntreprise);			
			} 

		}
	}

	
	public function deleteEntreprise () {
		if (isset ( $_POST['id'])){
	
			$reponses =  $this->employeurDAO->getEmployeurById ($_POST['id']);											  

			if (count($reponses) == 1) {
				$donnees = $reponses [0];
				$employes = $this->employeDAO->getEmployesByIdEntreprise ($_POST['id']);
				 
				foreach ($employes as $employe){
					 $this->deleteEmploye ($employe->getId(), $_POST['id']);
					 $this->division_EmployeDAO->deleteDivisionByEmployeId($employe->getId());
				}
				$this->employeurDAO->deleteEmployeurById($_POST['id']);
				$this->divisionDAO->deleteDivisionByEmployeurId($_POST['id']);
				$this->consultant_EmployeurDAO->deleteByEmployeurId($_POST['id']);
			}
		}
	}
	
	public function deleteEmploye ($idEmploye, $idEntreprise) {
		$this->employeDAO->deleteEmploye ($idEmploye, $idEntreprise);
		$this->evaluationBurnoutDAO->deleteEvaluationBurnout($idEmploye, $idEntreprise);
		$this->suivitEmployeDAO->deleteSuivitEmploye($idEmploye, $idEntreprise);
	}
	
	public function resetEmploye ($idEmploye, $idEntreprise) {
	    $this->evaluationBurnoutDAO->deleteEvaluationBurnout($idEmploye, $idEntreprise);
	    $this->suivitEmployeDAO->deleteSuivitEmploye($idEmploye, $idEntreprise);
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
	
	private function evaluationTable ($evaluation, $noEvaluation) {
	    $result =  '
			<h2>Evaluation Burnout num&eacute;ro ' . $noEvaluation . '</h2>
			<br/><br/>
	        
			<table class="table table-primary table-hover">
				<thead class="thead-primary">
					<tr>
						<th scope="col">question 1</th>
						<th scope="col">question 2</th>
						<th scope="col">question 3</th>
						<th scope="col">question 4</th>
						<th scope="col">question 5</th>
						<th scope="col">question 6</th>
                        <th scope="col">question 7</th>
                        <th scope="col">question 8</th>
                        <th scope="col">question 9</th>
                        <th scope="col">question 10</th>
                        <th scope="col">question 11</th>
						<th scope="col">question 12</th>
						<th scope="col">question 13</th>
						<th scope="col">question 14</th>
						<th scope="col">question 15</th>
						<th scope="col">question 16</th>
                        <th scope="col">question 17</th>
                        <th scope="col">question 18</th>
                        <th scope="col">question 19</th>
                        <th scope="col">question 20</th>
                        <th scope="col">question 21</th>
						<th scope="col">question 22</th>
				</tr>
				</thead>
				<tbody>';
	    
	    $result .= '<tr>';
	    $result .= '<td>' . $evaluation->getQuestion1() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion2() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion3() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion4() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion5() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion6() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion7() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion8() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion9() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion10() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion11() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion12() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion13() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion14() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion15() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion16() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion17() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion18() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion19() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion20() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion21() . '</td> ';
	    $result .= '<td>' . $evaluation->getQuestion22() . '</td> ';
	    $result .= '</tr>';
	    $result .= '</tbody>
			</table>';
	    
	    return $result;
	}

	public function creerEntrepriseForm () {
		echo '<form id="form" class="needs-validation" method="post" onsubmit="creerEntreprise(event);">';
		echo '<fieldset>';
		echo '	<legend>Cr&eacute;ation Entreprise</legend>';
		echo ' <div class="form-row">';
		echo '	<div class="form-group col-md-6">';
		echo '		<label for="entreprise"> Entreprise : </label>';
		echo '		<input type="text" name="entreprise" placeholder="nom entreprise" required="true" class="form-control" />';
		echo '    </div>';
		echo '    <div class="form-group col-md-6"> ';
		echo '		<label for="siret"> Siret : </label>';
		echo '		<input type="text" placeholder="SIRET" name="siret" required="true" class="form-control" />';
		echo '    </div>'; 
		echo '  </div>';

		echo '  <div class="form-row"> ';
		echo '  	<div class="form-group col-md-6">';
		echo '		  <label for="APE"> APE : </label>';
		echo '		  <input type="text" placeholder="APE" name="ape" required="true" class="form-control" />';
		echo '	    </div>';
		echo '      <div class="form-group col-md-6"> ';
		echo '		  <label for="adresse"> Adresse : </label>';
		echo '		  <input type="text" placeholder="addresse" name="adresse" required="true" class="form-control" />';
		echo '      </div>';
		echo '  </div>';

		echo '  <div class="form-row">';
		echo '  	<div class="form-group col-md-12">';
		echo '		<label for="logo"> Logo : </label>';
		echo '	    <div class="form-group col-md-12">';
    	echo '		   <input type="hidden" name="MAX_FILE_SIZE" value="2500000" />';
    	echo '		   <input type="file" id="logoEntreprise" name="logoEntreprise" name="logo" size="50000">';
		echo '	    </div>';
		echo '  </div> ';
		echo '  </div> ';

		echo '	<div class="form-row">';
		echo '	  <div class="form-group col-md-4">';
		echo '		<label for="dirigeant"> Nom du dirigeant : </label>';
		echo '		<input type="text" name="dirigeant" placeholder="nom dirigeant" required="true" class="form-control" />';
		echo '	  </div>';
		
		echo '	  <div class="form-group col-md-4">';
		echo '		<label for="email"> Email : </label>';
		echo '		<input type="email" class="form-control" placeholder="addresse mail" name="email" required="true"
                       class="form-control" />';
		echo '      <div class="valid-feedback">Valide</div>';
		echo '      <div class="invalid-feedback">Veuillez entrer un email valide</div>';
		echo '	  </div>';
		echo '	  <div class="form-group col-md-4">';
		echo '		<label for="password"> Mot de passe : </label>';
		echo '		<input type="password" name="password" required="true" class="form-control" placeholder="mot de passe"
                        pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"/>';
		echo '      <div class="valid-feedback">Valide</div>';
		echo '      <div class="invalid-feedback">Longueur minimale 8. dont au moins une majuscule et un nombre ou un caract&egrave;re sp&eacute;cial</div>';
		echo '    </div>';
		echo '  </div>';

		echo '	<input name="id" type="hidden"/> <br/>';
		echo '	<div class="form-group col-md-12">';
		echo '    <input type="submit" class="btn btn-primary btn-lg" value="Envoyer"/>';
		echo '	</div>';
		echo '</fieldset>';
		echo '</form>';	
		echo JS_CONTROL;
		echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
		
	}
	
	public function displayEntrepriseForm () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$results = $this->employeurDAO->findById($_POST['id']);
		if (count($results) == 1) {
			$donnees = $results [0];
			
			echo '<form id="form" class="needs-validation" method="post"  onsubmit="updateEntreprise(event,\''. $donnees->getId() . '\');">';
			echo '<fieldset>';
			echo '	<legend>Modifier Entreprise</legend>';
			echo ' <div class="form-row">';
			echo '	<div class="form-group col-md-6">';
			echo '		<label for="entreprise"> Entreprise : </label>';
			echo '		<input type="text" name="entreprise" placeholder="nom entreprise" required="true" class="form-control" value="'. $donnees->getNomEntreprise() . '" />';
			echo '    </div>';
			echo '    <div class="form-group col-md-6"> ';
			echo '		<label for="siret"> Siret : </label>';
			echo '		<input type="text" placeholder="SIRET" name="siret" required="true" class="form-control" value="'. $donnees->getSiret() . '"/>';
			echo '    </div>';
			echo '  </div>';
			
			echo '  <div class="form-row"> ';
			echo '  	<div class="form-group col-md-6">';
			echo '		  <label for="APE"> APE : </label>';
			echo '		  <input type="text" placeholder="APE" name="ape" required="true" class="form-control" value="'. $donnees->getAPE() . '"/>';
			echo '	    </div>';
			echo '      <div class="form-group col-md-6"> ';
			echo '		  <label for="adresse"> Adresse : </label>';
			echo '		  <input type="text" placeholder="addresse" name="adresse" required="true" class="form-control" value="'. $donnees->getAdresse() . '"/>';
			echo '      </div>';
			echo '  </div>';
			
			echo '  <div class="form-row">';
			echo '  	<div class="form-group col-md-6">';
			echo '		<label for="logo"> Logo : </label>';
			echo '		<img src="../controllers/DispatcherBackend.php?fonction=logoEntreprise&id='. $donnees->getid(). '" height="150" width="150" alt="logo entreprise" title="image"/>';
			echo '	</div>';
			echo '	<div class="form-group col-md-6">';
			echo '		<input type="hidden" name="MAX_FILE_SIZE" value="2500000" />';
			echo '		<input type="file" id="logoEntreprise" name="logoEntreprise" size="50000">';
			echo '	</div>';
			echo '  </div> ';
			
			echo '	<div class="form-row">';
			echo '	  <div class="form-group col-md-4">';
			echo '		<label for="dirigeant"> Nom du dirigeant : </label>';
			echo '		<input type="text" name="dirigeant" placeholder="nom dirigeant" required="true" class="form-control" value="'. $donnees->getDirigeant() . '"/>';
			echo '	  </div>';
			
			echo '	  <div class="form-group col-md-4">';
			echo '		<label for="email"> Email : </label>';
			echo '		<input type="email" class="form-control" placeholder="addresse mail" name="email" required="true"
                       class="form-control" />';
			echo '      <div class="valid-feedback">Valide</div>';
			echo '      <div class="invalid-feedback">Veuillez entrer un email valide</div>';
			echo '	  </div>';
			echo '	  <div class="form-group col-md-4">';
			echo '		<label for="password"> Mot de passe : </label>';
			echo '		<input type="password" name="password" class="form-control" placeholder="mot de passe"
                        pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"/>';
			echo '      <div class="valid-feedback">Valide</div>';
			echo '      <div class="invalid-feedback">Longueur minimale 8. dont au moins une majuscule et un nombre ou un caract&egrave;re sp&eacute;cial</div>';
			echo '    </div>';
			echo '  </div>';
			
			echo '  <div class="form-row">';
			echo '	<div class="form-group col-md-6">';
			echo '		<label for="bilan"> Bilan Initial </label>';
			echo '		<input type="range" class="form-control" min="0" max="1" step="1" name="bilan" value="'. $donnees->getBilan() . '"/>';
			echo '      <label> Bilan Final </label>';
			echo '	</div>';
			echo '	<div class="form-group col-md-6">';
			echo '		<label for="semaine"> Semaine de suivi : </label>';
			echo '		<input type="number" class="form-control" name="semaine" min="0" step="1" value="'. $donnees->getSemaine() . '"/>';
			echo '    </div>';
			echo '  </div>';
			
			echo '	<input name="id" type="hidden" value="'. $donnees->getId() . '"/>';
			echo '  <button class="btn btn-primary btn-lg" type="submit">Envoyer</button><br/>';
			echo '</fieldset>';
			echo '</form>';	
			echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
		}

		echo '<br/><br/><br/>';


		$entreprise = $results [0];
        $_SESSION ["noEntreprise"] = $entreprise->getId();
        $this->getDivisionForm ();
		
		echo '<br/><br/><br/>';
		echo '<form id="form2" onsubmit="addEmployesFromCsv(event);">';
		echo '<fieldset>';
		echo '	<legend>Informations Employ&eacute;s</legend>';
		echo '	<div class="form-row">';
		echo '	<input type="file" name="employes" id="employes" size="50">';
		echo '  <button class="btn btn-primary btn-lg" type="submit">Envoyer</button><br/>';
		echo '  </div> ';
		echo '</fieldset><br/><br/><br/>';
		echo '</form>';

		echo '<br/><br/><br/>';
		echo '<form id="form3" onsubmit="setOrganigramTree(event);">';
		echo '<fieldset>';
		echo '	<legend>Informations structure entreprise</legend>';
		echo '	<div class="form-row">';
		echo '	<input type="file" id="tree" name="tree" size="50">';
		echo '  <button class="btn btn-primary btn-lg" type="submit">Envoyer</button><br/>';
		echo '  </div> ';
		echo '</fieldset><br/><br/><br/>';
		echo '</form>';

		echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
	}

	public function getDivisionForm () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $entreprise = $this->employeurDAO->findById($_SESSION["noEntreprise"])[0];
        $divisions = $this->divisionDAO->findByEntrepriseId($entreprise->getId());

        if(count($divisions)>0) {
            echo '<div id="divisionForm"
                  <h2>Liste des divisions entreprise</h2>
    				<br/><br/>
    		    
    				<table class="table table-primary table-hover" id="divisionList">
    				<thead class="thead-primary">
    					<tr>
    						<th scope="col">Division</th>
    						<th scope="col">Parent</th>
    					</tr>
    				</thead>
    				<tbody>';



            foreach ($divisions as $division){
                echo '<tr>';
                echo '<td><input type="text" value="' . $division->getNom() . '" onchange="setDivisionName(this,' . $division->getId(). ')"/></td> ';
                echo '<td><select name="'. $division->getNom() . '" id="'. $division->getNom() . '" onchange="setParent(this,' . $division->getId(). ')">';
                foreach ($divisions as $div){
                    if ($div->getId() != $division->getId()) {
                        if ($div->getId() == $division->getIdDivision()) {
                            echo '<option value="'. $div->getId() . '" selected>'. $div->getNom() . '</option>';
                        }
                        else {
                            echo '<option value="'. $div->getId() . '" >'. $div->getNom() . '</option>';
                        }
                    }
                }
                echo '<option value="NULL" >None</option>';
                echo '</select></td>';
                echo '</tr>';
            }

            echo '</tbody>
    			</table>
    			</div>';
        }
    }
	
	public function setParent () {
	    $this->divisionDAO->updateDivisionParentId($_POST['divisionId'], $_POST['parentId']);
	}
	
	public function setDivisionName  () {
	    $this->divisionDAO->updateDivisionParentName($_POST['divisionId'], $_POST['inputValue']);
	}
	
	public function displayEntrepriseEmployes () {
		echo '<h2>Liste des Employ&eacute;s</h2>
				<br/><br/>
				
				<table class="table table-primary table-hover">
				<thead class="thead-primary">
					<tr>
						<th scope="col">Entreprise</th>
						<th scope="col">id</th>
						<th scope="col">VoirModifier</th>
                        <th scope="col">Reset</th>
						<th scope="col">Delete</th>
					</tr>
					</thead>
				<tbody>';
					
		$dataEntreprise = $this->employeurDAO->findById($_POST['id']);
		$employesEntreprise = $this->employeDAO->getEmployesByIdEntreprise ($_POST['id']);

		foreach ($employesEntreprise as $employe){
			echo '<tr>';
			echo '<td>' . $dataEntreprise[0]->getNomEntreprise() . '</td> ';
			echo '<td>' . $employe->getId() . '</td> ';
			echo '<td> <button class="btn btn-warning" onclick="displayEmployeForm ('. $employe->getId() . ','. $_POST['id'] . ')">Editer</button></td> ';
			echo '<td> <button class="btn btn-warning" onclick="resetEmploye ('. $employe->getId() . ','. $_POST['id'] . ')">Reset</button></td> ';
			echo '<td> <button class="btn btn-danger" onclick="deleteEmploye ('. $employe->getId() . ','. $_POST['id'] . ')">Supprimer</button></td> ';
			echo '</tr>';
		}

		echo '</tbody>
			</table>';
		echo '  <button type="button" class="btn btn-primary" onclick="displayAjouterEmployeForm(\''. $_POST['id'] . '\')">Ajouter Employ&eacute;</button><br/>';
		echo '  <button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour liste entreprise</button><br/>';
	}
	
	public function displayAjouterEmployeForm () {
	    $results = $this->employeurDAO->findById($_POST['id']);
	    echo '<form id="form" action="#" method="post" onsubmit="createEmploye(event,\''. $_POST['id'] . '\');">';
	        
	        echo '<fieldset>';
	        echo '	<legend>Informations Employ&eacute;</legend>';
	        echo '	<label for="email"> Email : </label>';
	        echo '	<input type="email" name="email" /><br/>';
	        echo '	<input name="id" type="hidden" value="'. $results[0]->getId() . '"/>';
	        echo '  <button class="btn btn-warning" type="submit">Envoyer</button><br/>';
	        
	        echo '</fieldset>';
	        echo '</form>';	
	}
	
	public function createEmploye () {
	    $email = htmlentities(strtolower(trim($_POST['email'])));
	    if(empty($email)) {return STATUS::fail;}
	    $newPassword = Utils::RandPassword(8);
	    $newEncryptedPassword = Utils::encryptPassword($newPassword);
	    $this->employeDAO->addEmploye (md5($email),$newEncryptedPassword,$_POST['id']);
	    //Envoie du mail pour r�g�nerer le mot de passe
	    Utils::SendRenewPasswordEmail($email,$newPassword);
	}
	
	public function displayEmployeForm () {
		
		$employe = $this->employeDAO->findById($_POST['id']);
		if (count ($employe) == 1) {
			$employe = $employe[0];
			echo '<form id="form" action="#" method="post" onsubmit="updateEmploye(event,\''. $_POST['id'] . '\');">';
				
				echo '<fieldset>';
				echo '	<legend>Informations Employ&eacute;</legend>';
				echo '	<label for="email"> Email : </label>';
				echo '	<input type="email" name="email" minlenght="4"/><br/>';
				echo '  <button class="btn btn-warning" type="submit">Envoyer</button><br/>';
				echo '</fieldset>';
			echo '</form>';	
			echo '<br/><br/>';
		}
		
		echo '<h2>Liste des Divisions Employe</h2>
				<br/><br/>
		    
				<table class="table table-primary table-hover">
				<thead class="thead-primary">
					<tr>
						<th scope="col">Division</th>
						<th scope="col">checkBox</th>
					</tr>
					</thead>
				<tbody>';
		
		$divisions = $this->divisionDAO->findByEntrepriseId($employe->getIdEntreprise());
		$division_employes = $this->division_EmployeDAO->findByIdEmploye($_POST['id']);
		
		foreach ($divisions as $division){
		    echo '<tr>';
		    echo '<td>' . $division->getNom() . '</td> ';
		    $checked = false;
		    foreach ($division_employes as $division_employe){
		        if ($division_employe->getId_division() == $division->getId()) {
		            $checked = true;
		        }
		    }
		    if ($checked == true) {
		        $checked = "checked";
		    } else {
		        $checked = "";
		    }
		    echo '<td> <input type="checkbox" ' . $checked . ' onchange="setDivision(event, \''.$division->getId().'\',\''. $_POST['id'] . '\')"/></td> ';
		    echo '</tr>';
		}
		
		echo '</tbody>
			</table>';

		echo '<button type="button" class="btn btn-primary" onclick="listeEntreprises()">Retour</button><br/>';
	}
	
	public function setDivision () {
	    if(!isset($_POST['idDivision']) || !isset($_POST['idEmploye'])) {return STATUS::fail;}
	    else {
	        $this->division_EmployeDAO->addDivision_Employe ($_POST['idEmploye'], $_POST['idDivision']);
	        return STATUS::success;
	    }
	}
	
	public function unSetDivision () {
	    if(!isset($_POST['idDivision']) || !isset($_POST['idEmploye'])) {return STATUS::fail;}
	    else {
	        $this->division_EmployeDAO->deleteDivisionByEmployeAndDivisionId($_POST['idEmploye'], $_POST['idDivision']);
	        return STATUS::success;
	    }
	}
	
	public function addEmployesFromCsv () {
		extract(filter_input_array(INPUT_POST));
		$file = $_FILES["file"]["name"];

		if ($file)
		{
			$fp = fopen ($_FILES["file"]["tmp_name"], "r");
			
			while(!feof($fp)) {
				$ligne = fgets($fp,4096);
				$liste = explode(";",$ligne);
				
				$email = $liste[0];
				$nomEntreprise = trim($liste[1]);
				$divisionName = trim($liste[2]);

				//trouver l'entreprise pour en extraire l'Id
				$employeur = $this->employeurDAO->findByNomEntreprise($nomEntreprise);
				//ajout de l'employe en base
				$newPassword = Utils::RandPassword(8);
				$newEncryptedPassword = Utils::encryptPassword($newPassword);
				$idEmploye = $this->employeDAO->addEmploye (md5($email),$newEncryptedPassword,$employeur[0]->getId());
				//Envoie du mail pour r�g�nerer le mot de passe
				Utils::SendRenewPasswordEmail($email,$newPassword);
				//recuperation de l'id de la division
				$division = $this->divisionDAO->findBynom($divisionName);
				$divisionId = $division->getId();

				//insertion de la relation employé division
				$this->division_EmployeDAO->addDivision_Employe($idEmploye,$divisionId);
				
			}
		}
	}
	
	public function setOrganigramTree () {
		extract(filter_input_array(INPUT_POST));
		$file = $_FILES["file"]["name"];

		if ($file)
		{
			$fp = fopen ($_FILES["file"]["tmp_name"], "r");
			
			while(!feof($fp)) {
				$ligne = fgets($fp,4096);
				$liste = explode(";",$ligne);
				
				$nomEntreprise = trim($liste[0]);
				$employeur = $this->employeurDAO->findByNomEntreprise($nomEntreprise);
				$nomDivision = trim($liste[1]);
				$divisionId = 0;

				$division = $this->divisionDAO->findBynom($nomDivision);
				    if ($division != NULL) {
					   $divisionId = $division->getId();
				    }
				    else {
				        $divisionId = $this->divisionDAO->addDivision2 ($nomDivision,$employeur[0]->getId());
				    }
				    for($i=2;$i<count ($liste);$i++) {
					//ajouter tous les �lements suivant en tant qu'enfant dans division
				        $this->divisionDAO->addDivision (trim($liste[$i]), $divisionId,$employeur[0]->getId());
				}
			}
		 
		}
	}

	public function setSuivitEmploye () {
		extract(filter_input_array(INPUT_POST));
		$file = $_FILES["file"]["name"];

		if ($file)
		{
			$fp = fopen ($_FILES["file"]["tmp_name"], "r");
			
			while(!feof($fp)) {
				$ligne = fgets($fp,4096);
				$liste = explode(";",$ligne);
				
				$emailEmploye = trim($liste[0]);
				$champs2 = trim($liste[1]);
				$champs3 = trim($liste[2]);
				$champs4 = trim($liste[3]);
				$champs5 = trim($liste[4]);
				$champs6 = trim($liste[5]);
				$champs7 = trim($liste[6]);
				$nomEntreprise = trim($liste[7]);

				$idEmploye = $this->employeDAO->findByEmail (md5($emailEmploye))[0]->getId();
				$idEntreprise = $this->employeurDAO->findByNomEntreprise($nomEntreprise)[0]->getId();		

			   $this->suivitEmployeDAO->addSuivitEmploye ($idEmploye,$champs2,$champs3,$champs4,$champs5,$champs6,$champs7,$idEntreprise);
			}
		}
	}

	public function setEvaluationBurnout () {
		extract(filter_input_array(INPUT_POST));
		$file = $_FILES["file"]["name"];

		if ($file)
		{
			$fp = fopen ($_FILES["file"]["tmp_name"], "r");
			
			while(!feof($fp)) {
				$ligne = fgets($fp,4096);
				$liste = explode(";",$ligne);
				
				$semaine = trim($liste[23]);
				$nomEntreprise = trim($liste[24]);
				$emailEmploye = trim($liste[0]);

				$employe = $this->employeDAO->findByEmail(md5($emailEmploye));
				$idEmploye = $employe[0]->getId();
				$idEntreprise = $this->employeurDAO->findByNomEntreprise($nomEntreprise)[0]->getId();
				
				$this->evaluationBurnoutDAO->insertEvaluationBurnout (trim($liste[1]), trim($liste[2]), trim($liste[3]), trim($liste[4]), trim($liste[5]), trim($liste[6]), trim($liste[7]), trim($liste[8]), trim($liste[9]), trim($liste[10]),
													  trim($liste[11]), trim($liste[12]), trim($liste[13]), trim($liste[14]), trim($liste[15]), trim($liste[16]), trim($liste[17]), trim($liste[18]),
													  trim($liste[19]), trim($liste[20]), trim($liste[21]), trim($liste[22]), $semaine, $idEntreprise, $idEmploye);
			}
		}
	}
	
	
	
	public function logoEntreprise () {
		if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
		$results = $this->employeurDAO->findById($_GET['id']);
		if(count ($results) == 1) {
			header('Content-Type: image');
			echo $results[0]->getLogo();
		}
	}
	
	public function connexion() {
	    return Utils::connexion($this->adminDAO, ID::idAdministrateur);
	}
	
	public function renouvelerMotDePasse () {
	    return Utils::renouvelerMotDePasse($this->adminDAO, ID::idAdministrateur);
	}
	
	public function sendRenewPasswordMail () {
	    Utils::sendRenewPasswordMail($this->adminDAO);
	}
	
	public function deconnexion () {
	    Utils::deconnexion();
	}
}


