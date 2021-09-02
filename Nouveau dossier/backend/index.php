<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/backend/header.php");
if (isset ($_SESSION["id"])) {
    if ($_SERVER['PHP_SELF'] == "/backend/index.php") {header('Location: ecranAdmin.php');}
}
include($_SERVER['DOCUMENT_ROOT'] . "/includes/import/authentification.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>
