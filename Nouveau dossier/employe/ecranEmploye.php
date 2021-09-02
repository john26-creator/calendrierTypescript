<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/employe/header.php");?>
<?php if (!isset ($_SESSION["idEmploye"])) {
    if ($_SERVER['PHP_SELF'] == "/employe/ecranEmploye.php") {echo '<script language="JavaScript">window.location=\'indexEmploye.php\'</script>';}
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeController.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

?>


	
	<div class="main">	
		<div class="container">
			
			<?php 
			$employe = new Employe;
			$test = $employe->getRGPD();
			echo $test;
			?>

    	<div class="row">        
            <div style="text-align:left;" class="col-6"> <span class="alert alert-warning">
		Derni&egrave;re connexion le <?php 
		$employeController = new EmployeController;
		echo $employeController->lastConnexion();
		?></span></div>
		<div class="col-2"></div>
		<div class="col-4">
		<img style="float:right; border-radius: 50%;" src="../controllers/DispatcherEmploye.php?fonction=logoEntreprise" height="100" width="100" alt="logo entreprise" title="image"/>
		</div>
	</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/employe/sideBarEmploye.php");?>


		<div id="mainContainer"></div>

	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");?>
