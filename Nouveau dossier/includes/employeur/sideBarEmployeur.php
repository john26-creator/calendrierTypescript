<?php 
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeurController.php");

$employeurController = new EmployeurController;
$sideBarVariables = $employeurController->getDisplayBarVariables();

?>

<nav id="sideBarEmployeur" class="navbar navbar-expand-lg navbar-dark bg-primary">
<a class="navbar-brand" href="#">Menu</a>
      <!-- Collapse button -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
		aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <!-- Collapsible content -->
	  <div class="collapse navbar-collapse" id="basicExampleNav">

		<!-- Links -->
		<ul class="navbar-nav mr-auto">
		  
		    <li class="nav-item active">
                <a class="nav-link" href="#" id="global" onclick="getAll(0)">Suivi bien-&ecirc;tre</a>
            </li>
		  
		  <li class="nav-item active">
			<a class="nav-link" href="#" id="infoPerso" onclick="infoPerso()">Informations Personnelles</a>
		  </li>

		  <!-- Dropdown -->
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Epuisement professionnel</a>
			<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink2">
			  <?php
				if ($sideBarVariables["DBI"]) {
					echo '<a class="dropdown-item" href="#" id="bilanInit" onclick="displayBilanInit()">R&eacute;sultat Bilan initial</a>';
				}
				if ($sideBarVariables["DBF"]) {
					echo '<a class="dropdown-item" href="#" id="bilanFin" onclick="displayBilanFin()">R&eacute;sultat bilan final</a>';
				} 
			  ?>
			</div>
		  </li>  
		</ul>
	</div>
</nav>