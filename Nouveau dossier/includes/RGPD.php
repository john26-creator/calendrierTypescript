<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/Employe.dao.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeController.php");

$reponseUser = htmlspecialchars($_POST['RGPD']);
$mentionsLu = htmlspecialchars($_POST['lu']);
$idUser = htmlspecialchars($_SESSION['idEmploye']);

$employe = new Employe;
echo "RGPD " . $_POST['RGPD'];
echo "Lu " . $_POST['lu'];
$employe->insertRGPD($reponseUser,$mentionsLu,$idUser);
if ($reponseUser && $mentionsLu) {
    header('location:../employe/ecranEmploye.php');
}
else {
    $employeController = new EmployeController;
    $sideBarVariables = $employeController->deconnexion();
    header('location:../employe/indexEmploye.php');
}

?>