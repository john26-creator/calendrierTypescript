<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/includes/employe/header.php");

if (isset($_SESSION["idEmploye"])) {
    if ($_SERVER['PHP_SELF'] == "/employe/indexEmploye.php") {

    echo '<script language="JavaScript">window.location=\'ecranEmploye.php\'</script>';
}
}
include($_SERVER['DOCUMENT_ROOT'] . "/includes/import/authentification.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>