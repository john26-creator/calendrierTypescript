<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Local.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Photo.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Equipement.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Disponibilite.php");

$localDAO = new Local;
$photoDAO = new Photo;
$equipementDAO = new Equipement;
$disponibiliteDAO = new Disponibilite;

$locaux = $localDAO->findAll();


?>