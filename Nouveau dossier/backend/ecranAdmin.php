<?php
include($_SERVER['DOCUMENT_ROOT'] . "/includes/backend/header.php");
if (!isset ($_SESSION["id"])) {
    if ($_SERVER['PHP_SELF'] == "/backend/ecranAdmin.php") {header('Location: index.php');}
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/BackendController.php");
?>
<div class="main">
<div id="mainContainer">
	<div id="lastConnexion" class="alert alert-warning">
		Derni&egrave;re connexion le <?php 
		$backendController = new BackendController;
		echo $backendController->lastConnexion();
		?>
	</div>
	<h2>Liste des Entreprises</h2>
	<br/>

	<div class="table-responsive">
	<table class="table table-primary table-hover">
		<thead>
			<tr>
				<th scope="col">Entreprise</th>
				<th scope="col">Dirigeant</th>
				<th scope="col">Siret</th>
				<th scope="col">APE</th>
				<th scope="col">Semaine</th>
				<th scope="col">Bilan</th>
				<th scope="col">Logo</th>
				<th scope="col">Supprimer</th>
				<th scope="col">Modifier</th>
				<th scope="col">Collaborateurs</th>
			</tr>
		</thead>
		<tbody>
		
	<?php
    	$results = $backendController->findAll();
    	
    	foreach ($results as $result){
    		echo '<tr>';
    		echo '<th scope="row">' . $result->getNomEntreprise(). '</th> ';
    		echo '<td>' . $result->getDirigeant(). '</td> ';
    		echo '<td>' . $result->getSiret(). '</td> ';
    		echo '<td>' . $result->getAPE(). '</td> ';
    		echo '<td>' . $result->getSemaine(). '</td> ';
    		$bilan = "Initial";
    		if ($result->getBilan() == 1) { $bilan = "Final"; }
    		echo "<td>".$bilan."</td> ";
    		echo '<td><img src="../controllers/DispatcherBackend.php?fonction=logoEntreprise&id='. $result->getid(). '" height="50" width="50" alt="logo entreprise" title="image"/></td>';
    		echo '<td> <i style="color:red;font-size: 27px;" class="fas fa-trash-alt" onclick="deleteEntreprise('. $result->getid(). ')"></i></td> ';
    		echo '<td> <i style="color:#203a5d;font-size: 27px;" class="fas fa-pen" onclick="displayEntrepriseForm ('. $result->getid(). ')"></i></td> ';
    		echo '<td> <i style="color:#4ebac3;font-size: 27px;" class="fas fa-user-friends" onclick="displayEntrepriseEmployes ('. $result->getid(). ')"></i></td> ';
    		echo '</tr>';
    	}
	
	?>
	</tbody>
	</table>
	</div>

	<br/><br/>
	<button class="btn btn-primary" onclick="displayCreerEntreprise ()">Créer entreprise</button>
	
	<br/><br/><br/>
	<h2>Liste des Consultants</h2>
	
	<br/><br/>
	<div class="table-responsive">
	<table class="table table-primary table-hover">
		<thead class="thead-primary">
			<tr>
				<th scope="col">Nom</th>
				<th scope="col">Pr&eacute;nom</th>
				<th scope="col">Supprimer</th>
				<th scope="col">Modifier</th>
				<th scope="col">Modifier Entreprises</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		  $results = $backendController->findAllConsultant();
		  
		  foreach ($results as $result){
		      echo '<tr>';
		      echo '<th scope="row">' . $result->getNom(). '</th> ';
		      echo '<td>' . $result->getPrenom(). '</td> ';
		      echo '<td> <i style="color:red; font-size: 27px;" class="fas fa-trash-alt" onclick="deleteConsultant('. $result->getId(). ')"></i></td> ';
		      echo '<td> <i style="color:#203a5d;font-size: 27px;" class="fas fa-pen" onclick="displayConsultantForm ('. $result->getId(). ')"></i></td> ';
		      echo '<td> <i style="color:#4ebac3;font-size: 27px;" class="fas fa-building"  onclick="displayConsultantEntreprises ('. $result->getId(). ')"></i></td> ';
		      echo '</tr>';
		  }
		?>
		</tbody>
	</table>
</div>
	<br/><br/>
	<button class="btn btn-primary" onclick="displayCreerConsultant ()">Créer consultant</button>
</div>

	<br/><br/>

<br/><br/>

<br/><br/>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");?>
