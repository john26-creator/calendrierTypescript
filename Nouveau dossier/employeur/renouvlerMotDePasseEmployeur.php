<?php 
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
if (!isset ($_SESSION["renewPassword"]) || $_SESSION["renewPassword"] != 1) {
    if ($_SERVER['PHP_SELF'] == "/employeur/renouvlerMotDePasseEmployeur.php") {header('Location: ecranEmployeur.php');}
}?>
<html>
<head>
    <meta name="robots" content="noindex">

    <link rel="stylesheet" type="text/css" href="/includes/import/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../includes/employeur/sideBarEmployeur.js"></script>
    <script src="../includes/common.js"></script>
    <script src="../includes/employeurConsultantTraitements.js"></script>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/import/formulaireRenouvelerMotDepasse.php");?>