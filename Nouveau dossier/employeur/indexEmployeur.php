<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/includes/employeur/header.php");
if (isset ($_SESSION["entreprise"])) {
    if ($_SERVER['PHP_SELF'] == "/employeur/indexEmployeur.php") {header('Location: ecranEmployeur.php');}
}
include($_SERVER['DOCUMENT_ROOT'] . "/includes/import/authentification.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>