<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/BackendController.php");

$backendController = new BackendController;

$result = null;
if (isset ($_POST ['fonction'])) {
	switch ($_POST ['fonction']) {
	    case "createEmploye":
	        $result = $backendController->createEmploye ();
	        break;
		case "updateEmploye":
			$result = $backendController->updateEmploye ();
			break;
		case "setDivision":
		    $result = $backendController->setDivision ();
		    break;
		case "unSetDivision":
		    $result = $backendController->unSetDivision ();
		    break;
		case "updateEmploye2":
		    $result = $backendController->updateEmploye ();
			break;
		case "updateEntreprise":
			$result = $backendController->updateEntreprise ();
			break;
			
		case "displayCreerConsultant":	
		    $result = $backendController->displayCreerConsultant ();
		    break;
		case 'displayConsultantForm':
		    $result = $backendController->displayConsultantForm ();
		    break;
		case 'setEntreprise':
		    $result = $backendController->setEntreprise ();
		    break;
		case 'unSetEntreprise':
		    $result = $backendController->unSetEntreprise ();
		    break;
		case 'displayConsultantEntreprises':
		    $result = $backendController->displayConsultantEntreprises ();
		    break;
		case 'displayAjouterEmployeForm':
		    $result = $backendController->displayAjouterEmployeForm ();
		    break;
		case 'creerConsultant':
		    $result = $backendController->CreerConsultant ();
		    break;
		case 'updateConsultant':
		    $result = $backendController->updateConsultant ();
		    break;
		case 'deleteConsultant':
		    $result = $backendController->deleteConsultant ();
		    break;
		case "deleteEntreprise":
		    $result = $backendController->deleteEntreprise ();
			break;
		case "resetEmploye":
		    $result = $backendController->resetEmploye ($_POST['id'], $_POST['idEntreprise']);
		    break;
		case "deleteEmploye":
			$result = $backendController->deleteEmploye ($_POST['id'], $_POST['idEntreprise']);
			break;
		case "displayEntrepriseForm":
			$result = $backendController->displayEntrepriseForm ();
			break;
		case "displayEmployeForm":
			$result = $backendController->displayEmployeForm ();
			break;
		case "displayEntrepriseEmployes":
			$result = $backendController->displayEntrepriseEmployes ();
			break;
		case "addEmployesFromCsv":
			$result = $backendController->addEmployesFromCsv();
			break;
		case "setOrganigramTree":
			$result = $backendController->setOrganigramTree();
			break;
		case "setSuivitEmploye":
			$result = $backendController->setSuivitEmploye();
			break;
		case "setEvaluationBurnout":
			$result = $backendController->setEvaluationBurnout();
			break;
		case "connexion":
			$result = $backendController->connexion();
			break;
		case "sendRenewPasswordMail":
		    $result = $backendController->sendRenewPasswordMail();
		    break;
		case "renouvelerMotDePasse":
		    $result = $backendController->renouvelerMotDePasse ();
		    break;
		case "deconnexion":
			$result = $backendController->deconnexion ();
			break;
		case "creerEntrepriseForm":
			$result = $backendController->creerEntrepriseForm ();
			break;
		case "creerEntreprise":
			$result = $backendController->creerEntreprise ();
			break;
		case "setParent":
		    $result = $backendController->setParent ();
		    break;
		case "setDivisionName":
		    $result = $backendController->setDivisionName ();
		    break;
        case "getDivisionForm":
            $result = $backendController->getDivisionForm ();
            break;
	}
} else {
	if (isset ($_GET ['fonction'])) {
		switch ($_GET ['fonction']) {
			case "logoEntreprise":
				$result = $backendController->logoEntreprise ();
			break;
		}
	}
}
echo $result;
