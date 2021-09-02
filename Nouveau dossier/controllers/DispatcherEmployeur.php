<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeurController.php");
$employeurController = new EmployeurController;
$result = null;
if (isset ($_POST ['fonction'])) {
	switch ($_POST ['fonction']) {
		case "infoPerso":
			$result = $employeurController->getInfoPersoEmployeur ();
			break;
		case "getAll":
            $result = $employeurController->getAll ($_POST ['division']);
            break;
		case "connexion":
			$result = $employeurController->connexion();
			break;
		case "deconnexion":
			$employeurController->deconnexion ();
			$result = Status::success;
			break;
		case "sendRenewPasswordMail":
		    $employeurController->sendRenewPasswordMail();
            $result = Status::success;
		    break;
		case "renouvelerMotDePasse":
		    $result = $employeurController->renouvelerMotDePasse ();
		    break;
		case "diplayBilanInit":
			$result = $employeurController->diplayBilanInit ($_POST ['division']);
			break;
		case "diplayBilanFin":
			$result = $employeurController->diplayBilanFin ($_POST ['division']);
			break;
		case "divisions":
			$result = $employeurController->getDivisions ();
			break;
	}
	
} else {
	if (isset ($_GET ['fonction'])) {
		switch ($_GET ['fonction']) {
			case "diplayBilanInit":
				$result = $employeurController->diplayBilanInit ();
				break;
			case "diplayBilanFin":
				$result = $employeurController->diplayBilanFin ();
				break;
			case "logoEntreprise":
				$result = $employeurController->logoEntreprise ();
			break;
		}
	}
}
echo $result;