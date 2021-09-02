<?php
try {
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeController.php");
$employeController = new EmployeController;

$result=null;
if (isset ($_POST ['fonction'])) {
	switch ($_POST ['fonction']) {
		case "infoPerso":
			$result = $employeController->getInfoPersoEmploye ();
			break;
        case "getAll":
            $result = $employeController->getAll ($_POST ['division']);
            break;
		case "submitBurnout":
			$result = $employeController->submitBurnout ();
			break;
		case "divisions":
			$result = $employeController->getDivisions ();
			break;
		case "diplayBilanInit":
			$result = $employeController->diplayBilanInit ();
			break;
		case "diplayBilanFin":
			$result = $employeController->diplayBilanFin ();
			break;
		case "submitSuivit":
			$result = $employeController->submitSuivit ();
			break;
		case "refreshSideBar":
			$result = $employeController->refreshSideBar ();
			break;
		case "downloadEmployeInfo":
		    $result = $employeController->downloadEmployeInfo ();
		    break;
		case "connexion":
			$result = $employeController->connexion ();
			break;
		case "sendRenewPasswordMail": 
		    $result = $employeController->sendRenewPasswordMail();
		    break;
		case "renouvelerMotDePasse":
		    $result = $employeController->renouvelerMotDePasse ();
		    break;
		case "deconnexion":
			$result = $employeController->deconnexion ();
			break;
	}
}
else {
	if (isset ($_GET ['fonction'])) {
		switch ($_GET ['fonction']) {
			case "displayMBIResult" :	
			$result = $employeController->displayMBIResult ();
			break;
			case "logoEntreprise":
			    $result = $employeController->logoEntreprise ();
			break;
		}
	}
}
echo $result;
}
catch (Throwable $t) {
	var_dump($t);
}