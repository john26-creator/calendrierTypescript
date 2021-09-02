<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/employeur/header.php");?>
<?php if (!isset ($_SESSION["entreprise"])) {
    if ($_SERVER['PHP_SELF'] == "/employeur/ecranEmployeur.php") {header('Location: indexEmployeur.php');}
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeurController.php");
?>
<div class="main">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/employeur/sideBarEmployeur.php");?>
	<div id="lastConnexion">
		Derni&egrave;re connexion le <?php 
		$employeurController = new EmployeurController;
		echo $employeurController->lastConnexion();
		?>

		
</div>
<div id="mainContainer"></div>

</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");?>